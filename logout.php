<?php
session_start();
$log = fopen("../log/log.txt", "a") or die("Unable to open file!");
$insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Erfolgreicher Logout von: "  .  $_SESSION['data'] . "\r";
fwrite($log, $insert_log);
fclose($log);
session_destroy();
echo "<script> location.replace(\"index.php\"); </script>";
