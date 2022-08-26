<?php
  $data = ['hey','how', 'are','you','doing'];
  echo "==> ".implode(",",$data);
  if (($key = array_search('are', $data)) !== false) {
    unset($data[$key]);
  }

  echo "==> ".implode(",",$data);
?>