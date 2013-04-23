<?php

/*
 * Function to return data requested via External hits
 */
function get_data() {
  if (isset($_GET['type']) && !empty($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == 'retailers') {
      $nids = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->condition('n.type', $type)
        ->execute()
        ->fetchAll(PDO::FETCH_COLUMN);
      $data = array();
      foreach ($nids as $nid) {
        $node = node_load($nid);
        $data[$nid]['nid'] = $node->nid;
        $data[$nid]['status'] = $node->status;
        $data[$nid]['created'] = $node->created;
        $data[$nid]['changed'] = $node->changed;
        $data[$nid]['title'] = $node->title;
        if (!empty($node->body)) {
          $data[$nid]['body'] = $node->body['und'][0]['value'];
        }
        if (!empty($node->field_display_text['und'][0]['value'])) {
          $data[$nid]['display_text'] = $node->field_display_text['und'][0]['value'];
        }
        $data[$nid]['url'] = $node->field_url['und'][0]['value'];
        if (!empty($node->field_image)) {
          $data[$nid]['image'] = file_create_url($node->field_image['und'][0]['uri']);
        }
        foreach ($node->field_country['und'] as $country) {
          $data[$nid]['country'][] = taxonomy_term_load($country['tid'])->name;
        }
        foreach ($node->field_category['und'] as $category) {
          $data[$nid]['category'][] = taxonomy_term_load($category['tid'])->name;
        }
        $data[$nid]['type'] = taxonomy_term_load($node->field_type['und'][0]['tid'])->name;
        if (!empty($node->field_tracking_url)) {
          $tracking_urls_ids = array();
          foreach ($node->field_tracking_url['und'] as $field_tracking_url) {
            $tracking_urls_ids[] = $field_tracking_url;
          }
          $tracking_urls = entity_load('field_collection_item' ,$tracking_urls_ids);
          foreach ($tracking_urls as $tracking_url) {
            if (!empty($tracking_url->field_affiliate['und'][0]['tid'])) {
              $data[$nid]['tracking_url'][$tracking_url->item_id]['affiliate'] = taxonomy_term_load($tracking_url->field_affiliate['und'][0]['tid'])->name;
            }
            if (!empty($tracking_url->field_url_part1['und'][0]['value'])) {
              $data[$nid]['tracking_url'][$tracking_url->item_id]['url_part1'] = $tracking_url->field_url_part1['und'][0]['value'];
            }
            if (!empty($tracking_url->field_url_part2['und'][0]['value'])) {
              $data[$nid]['tracking_url'][$tracking_url->item_id]['url_part2'] = $tracking_url->field_url_part2['und'][0]['value'];
            }
            if (!empty($tracking_url->field_url_part3['und'][0]['value'])) {
              $data[$nid]['tracking_url'][$tracking_url->item_id]['url_part3'] = $tracking_url->field_url_part3['und'][0]['value'];
            }
            if (!empty($tracking_url->field_url_part4['und'][0]['value'])) {
              $data[$nid]['tracking_url'][$tracking_url->item_id]['url_part4'] = $tracking_url->field_url_part4['und'][0]['value'];
            }
          }          
        }
        $data[$nid]['primary_category'] = taxonomy_term_load($node->field_primary_category['und'][0]['tid'])->name;
        if (!empty($node->field_active_affiliate['und'][0]['tid'])) {
          $data[$nid]['active_affiliate'] = taxonomy_term_load($node->field_active_affiliate['und'][0]['tid'])->name;
        }
        if (!empty($node->field_is_popular)) {
          $data[$nid]['popular'] = $node->field_is_popular['und'][0]['value'];
        }        
      }
    }
    elseif ($type == 'interest') {
      $nids = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->condition('n.type', 'sites_of_interest')
        ->execute()
        ->fetchAll(PDO::FETCH_COLUMN);
      $data = array();
      foreach ($nids as $nid) {
        $node = node_load($nid);
        $data[$nid]['nid'] = $node->nid;
        $data[$nid]['status'] = $node->status;
        $data[$nid]['created'] = $node->created;
        $data[$nid]['changed'] = $node->changed;
        $data[$nid]['title'] = $node->title;
        if (!empty($node->body)) {
          $data[$nid]['body'] = $node->body['und'][0]['value'];
        }
        if (!empty($node->field_url_site_of_interest)) {
          $data[$nid]['url'] = $node->field_url_site_of_interest['und'][0]['value'];
        }
        if (!empty($node->field_category)) {
          foreach ($node->field_category['und'] as $category) {
            $data[$nid]['categories'][] = taxonomy_term_load($category['tid'])->name;
          }
        }
        if (!empty($node->field_country)) {
          foreach ($node->field_country['und'] as $country) {
            $data[$nid]['countries'][] = taxonomy_term_load($country['tid'])->name;
          }
        }
      }
    }
    drupal_json_output($data);
  }
}
?>
