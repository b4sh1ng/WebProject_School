<?php
session_start();
$fakey = $_SESSION['key'];
$userid = $_SESSION['loginid'];
$current_code_2fa = trim(shell_exec("oathtool --base32 --totp $fakey"));
if ($_POST['code'] == $current_code_2fa) {
    $log = fopen("../log/log.txt", "a") or die("Unable to open file!");
    $insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Erfolgreicher Login von: $userid\r";
    fwrite($log, $insert_log);
    fclose($log);
    $_SESSION['data'] = $userid;
    header("Location: ./management.php");
} else {
    $_SESSION['fail'] = true;
    header("Location: 2fa_check.php");
}
