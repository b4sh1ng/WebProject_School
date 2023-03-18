<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin_view.css" type="text/css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>BackUp | Login</title>
</head>

<body style="background-color:#1E90FF">
    <div class="d-flex justify-content-evenly">
        <div>
            <h1>Login Backupsystem</h1>
            <form action="admin_login.php" method="post">
                <label>Login ID</label>
                <input type="text" name="loginId"
                    value=<?php echo isset($_POST['value']) ? htmlspecialchars($_POST['value']) : null ?>>
                <br>
                <label>Passwort</label>
                <input type="password" name="passwd"
                    value=<?php echo isset($_POST['value']) ? htmlspecialchars($_POST['value']) : null ?>>
                <br>
                <br>
                <input type="submit" Name="btn_login" value="Einloggen" />
            </form>
            <?php
            if (isset($_POST['btn_login'])) {
                $log = fopen("../log/log.txt", "a") or die("Unable to open file!");
                require_once('../mysql.inc.php');
                try {
                    $dsn = "mysql:host=$db_host;dbname=$db_name;";
                    $pdo = new PDO($dsn, $db_user, $db_pwd);
                } catch (PDOException $er) {
                    echo "Failed: " . $er;
                }
                $stmt = $pdo->prepare('SELECT * FROM daten WHERE loginid=(:Lid)');
                $stmt->bindValue(':Lid', $_POST['loginId']);
                $stmt->execute();
                while ($item = $stmt->fetch()) {
                    $userid = $item['loginid'];
                    $password = $item['pwd'];
                    $access_lvl = $item['access_lvl'];
                }

                $pwdVerify = password_verify($_POST['passwd'], $password);
                if ($_POST['loginId'] == $userid && $pwdVerify && $access_lvl >= 10) {
                    $insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Erfolgreicher Login von: $userid\r";
                    fwrite($log, $insert_log);
                    fclose($log);
                    session_start();
                    $_SESSION['redakteur'] = $userid;
                    header("Location: ./admin_view.php");
                } else {
                    $insert_log = "[" . date("Y-m-d H:i:s") . "]" . "Nicht erfolgreicher Login von: $userid!\r";
                    fwrite($log, $insert_log);
                    fclose($log);
                    echo "Login versuch gescheitert! Überprüfe ID und Passwort! <br>  Oder du hast keine Berechtigung dazu!";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>