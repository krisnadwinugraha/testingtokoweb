<?php
for ($i = 1; $i <= 100; $i++) {
  if ($i % 2 == 1) {
    if ($i % 4 == 3) {
      echo "sa ";
    } else {
      echo "bi ";
    }
  } else {
    echo $i . " ";
  }
}
?>