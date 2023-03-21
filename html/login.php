<?php
session_start();
$_SESSION['fail'] = "yes";
$log = fopen("../log/log.txt", "a") or die("Unable to open file!");
require_once('../mysql.inc.php');
try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;";
    $pdo = new PDO($dsn, $db_user, $db_pwd);
} catch (PDOException $er) {
    echo "Failed: " . $er;
}
$stmt = $pdo->prepare('SELECT * FROM daten WHERE loginid=(:Lid)');
$stmt->bindValue(':Lid', $_POST['login']);
$stmt->execute();
while ($item = $stmt->fetch()) {
    $userid = $item['loginid'];
    $password = $item['pwd'];
    $access_lvl = $item['access_lvl'];
    $fakey =  $item['2fa_key'];
}
$_SESSION['loginid'] = $userid;
$_SESSION['key'] = $fakey;
$pwdVerify = password_verify($_POST['passwd'], $password);
if (!($fakey == "NULL") && $_POST['login'] == $userid && $pwdVerify && $access_lvl >= 10) {
    fclose($log);
    header("Location: 2fa_check.php");
} else if ($_POST['login'] == $userid && $pwdVerify && $access_lvl >= 10 && ($fakey == "NULL")) {
    $insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Erfolgreicher Login von: $userid\r";
    fwrite($log, $insert_log);
    fclose($log);
    session_start();
    $_SESSION['data'] = $userid;
    header("Location: management.php");
} else {
    $insert_log = "[" . date("Y-m-d H:i:s") . "]" . "Nicht erfolgreicher Login von: $userid!\r";
    fwrite($log, $insert_log);
    fclose($log);
    $_SESSION['fail'] = "no";
    header("Location: index.php");
}
