<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

function corp_enhancements_admin_reports($url, $csv = false) {

  $return = '';
  $function = 'corp_enhancements_admin_reports_'.$url;

  if (function_exists($function)) {
    $return = call_user_func($function, $csv);
  }

  return $return;
}


/**
 * Export omg transaction reocrds to csv.
 */
function corp_enhancements_admin_reports_omg_transaction_records($csv = null) {
  $validated_buyer = db_select('omg_user_rewards', 'o')
      ->fields('o', array('drupal_uid', 'omg_status', 'omg_transaction_id','omg_reward_percentage','omg_reward_type'));
  $validated_buyer->addExpression('sum(omg_reward)', 'validated_buyer');
  $validated_buyer->addExpression('0', 'validated_referrer');
  $validated_buyer->addExpression('0', 'buyer_pending');
  $validated_buyer->addExpression('0', 'referral_pending');
  $validated_buyer->condition('omg_status', 'Validated');
  $validated_buyer->condition('omg_reward_type', 'Buyer')->groupBy('drupal_uid');

  $validated_referrer = db_select('omg_user_rewards', 'o')
      ->fields('o', array('drupal_uid', 'omg_status', 'omg_transaction_id','omg_reward_percentage','omg_reward_type'));
  $validated_referrer->addExpression('0', 'validated_buyer');
  $validated_referrer->addExpression('sum(omg_reward)', 'validated_referrer');
  $validated_referrer->addExpression('0', 'buyer_pending');
  $validated_referrer->addExpression('0', 'referral_pending');
  $validated_referrer->condition('omg_status', 'Validated');
  $validated_referrer->condition('omg_reward_type', 'Referrer')->groupBy('drupal_uid');

  $buyer_pending = db_select('omg_user_rewards', 'o')
      ->fields('o', array('drupal_uid', 'omg_status', 'omg_transaction_id','omg_reward_percentage','omg_reward_type'));
  $buyer_pending->addExpression('0', 'validated_buyer');
  $buyer_pending->addExpression('0', 'validated_referrer');
  $buyer_pending->addExpression('sum(omg_reward)', 'buyer_pending');
  $buyer_pending->addExpression('0', 'referral_pending');
  $buyer_pending->condition('omg_status', 'Pending');
  $buyer_pending->condition('omg_reward_type', 'Buyer')->groupBy('drupal_uid');


  $referral_pending = db_select('omg_user_rewards', 'o')
      ->fields('o', array('drupal_uid', 'omg_status', 'omg_transaction_id','omg_reward_percentage','omg_reward_type'));
  $referral_pending->addExpression('0', 'validated_buyer');
  $referral_pending->addExpression('0', 'validated_referrer');
  $referral_pending->addExpression('0', 'buyer_pending');
  $referral_pending->addExpression('sum(omg_reward)', 'referral_pending');
  $referral_pending->condition('omg_status', 'Pending');
  $referral_pending->condition('omg_reward_type', 'Referrer')->groupBy('drupal_uid');




  $validated_buyer->union($validated_referrer, 'UNION ALL');
  $validated_buyer->union($buyer_pending, 'UNION ALL');
  $validated_buyer->union($referral_pending, 'UNION ALL');

  $query = db_select($validated_buyer, 'q');
  $query->fields('q',array('drupal_uid'))->groupBy('drupal_uid');

  $query->leftJoin('users','u','u.uid = q.drupal_uid');
  $query->fields('u', array('name','mail'));
  $query->addExpression('sum(validated_buyer)','validated_buyer');
  $query->addExpression('sum(validated_referrer)','validated_referrer');
  $query->addExpression('sum(buyer_pending)','buyer_pending');
  $query->addExpression('sum(referral_pending)','referral_pending');


  // Setting the sort conditions
  if(isset($_GET['sort']) && isset($_GET['order'])) {
    // Sort it Ascending or Descending?
    if($_GET['sort'] == 'asc')
      $sort = 'ASC';
    else
      $sort = 'DESC';

    // Which column will be sorted
    switch($_GET['order']) {
      case 'Name':
        $order = 'name';
        break;
      case 'Email':
        $order = 'mail';
        break;
      case 'Validated Buyer Rewards':
        $order = 'validated_buyer';
        break;
      case 'Validated Referral Rewards':
        $order = 'validated_referrer';
        break;
      case 'Pending Buyer Rewards':
        $order = 'buyer_pending';
        break;
      case 'Pending Referral Rewards':
        $order = 'buyer_pending';
        break;
    }
  }
  else {
    $sort = 'ASC';
    $order = 'drupal_uid';
  }
  $sort = $sort . ', omg_status, omg_reward_type';

  // Set order by
  $query->orderBy($order, $sort);

#echo $query;exit;
  // Pagination
  if (empty($csv)) {
    $query = $query->extend('TableSort')->extend('PagerDefault')->limit(100);
    $header = array(
        array('data' => 'Name', 'field' => 'name', 'width'=>'20%'),
        array('data' => 'Email', 'field' => 'mail'),
        array('data' => 'UID'),
        array('data' => 'Validated Buyer Rewards', 'field' => 'validated_buyer'),
        array('data' => 'Validated Referral Rewards', 'field' => 'validated_referrer'),
        array('data' => 'Total Validated Rewards'),
        array('data' => 'Pending Buyer Rewards', 'field' => 'buyer_pending'),
        array('data' => 'Pending Referral Rewards', 'field' => 'referral_pending'),
        array('data' => 'Total Pending Rewards'),
    );
  }else {
    $rows[] = array('Name','Email','UID','Validated Buyer Rewards',
        'Validated Referral Rewards','Total Validated Rewards',
        'Pending Buyer Rewards','Pending Referral Rewards',
        'Total Pending Rewards'
    );
  }

  $result =  $query->execute();

  while ($row = $result->fetchObject()) {
    $rows[] = array(
        $row->name,
        $row->mail,
        $row->drupal_uid,
        round($row->validated_buyer,2),
        round($row->validated_referrer,2),
        (round($row->validated_referrer,2) + round($row->validated_buyer,2)),
        round($row->buyer_pending,2),
        round($row->referral_pending,2),
        (round($row->buyer_pending,2) +  round($row->referral_pending,2)),
    );

  }

  if (empty($csv)) {
    return corp_enhancements_table_export('OMG Trasaction Report', $header, $rows);
  }else {
    corp_enhancements_csv_export('omg_transaction_report', $rows);
  }

}
