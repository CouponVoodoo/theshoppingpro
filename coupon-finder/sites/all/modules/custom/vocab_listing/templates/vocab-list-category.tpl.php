<div class="vocab-list vocab-list-category">
<?php
$row = 0;
foreach ($terms as $term) {
  if (in_array(0, $term->parents)) {
    if ($row == 0) {
      echo '<div class="vocab-list-parent">';
      $row++;
    } else {
      echo '</div><div class="vocab-list-parent">';
      $row++;
    }
?>
<h2>
<?php
  echo t('%name\'s Fashion', array('%name' => $term->name));
?>
</h2>
<?php
  } else {
?>
  <div class="vocab-list-term"><?php echo l($term->name, ''); ?></div>
<?php
  }
}
if ($row != 0) {
  echo '</div>';
}
?>
</div>