<!DOCTYPE html>
<html lang="de">

<head>
    <?php
    require_once('./session_backup.inc.php');
    require("../mysql.inc.php");
    $db_loginId = $db_user;
    $db_pass = $db_pwd;
    $db = $db_name;
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin_view.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>BackUp | Manager</title>
</head>

<body style="background-color:#3b3b3b">
    <div class="outerDiv">
        <div class="leftDiv">
            <h3 style="margin: 5px;">Backup Liste</h3>
            <form action="admin_view.php" method="post">
                <!--BackUp View hier einfügen-->
                <div class="scroll-view">
                    <table class="table table-striped table-dark table-hover table-sm rounded" id="backup_tab">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Log Datum</th>
                                <th>Auswahl</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $backupPath = "../backup";
                            $dataInPath = scandir($backupPath);
                            $dataInPath = array_reverse($dataInPath);
                            $iter = 1;
                            foreach ($dataInPath as $data) {
                                if (!preg_match("/\.(sql)$/", $data)) {
                                    continue;
                                }
                                echo "<tr id='row " . $iter . "'>
                            <td>$iter</td>
                            <td>$data</td>
                            <td>
                            <input style=\"margin-left: 25px;\" type=\"checkbox\" name=\"auswahl[]\" value=\"$data\"/>
                            </td>
                            </tr>";
                                $iter = $iter + 1;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="button-container">
                    <input type="submit" value="Backup erstellen" name="btn_bErstellen" class="btn btn-success"
                        style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="submit" value="Backup Vorschau" name="btn_bVorschau" class="btn btn-primary"
                        style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="submit" value="Log laden" name="btn_logLaden" class="btn btn-warning"
                        style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="submit" value="Ausloggen" name="btn_logout" class="btn btn-warning"
                        style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="hidden" name="selectedFile" id="selectedFile" value="" />
                </div>
        </div>
        <div class="rightDiv">
            <div style="margin: 5px;">
                <h2 style="margin-left: 5px;">Vorschau</h2>
                <div class="scroll-view" style="margin:1em; background-color: grey;">
                    <?php
                    if (isset($_POST['btn_bErstellen'])) {
                        $log = fopen("../log/backup-usage.txt", "a") or die("Unable to open file!");
                        $insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Backup erstellt von: " .  $_SESSION['redakteur'] . "\r";
                        fwrite($log, $insert_log);
                        fclose($log);
                        shell_exec("/bin/bash ../backup/backup.sh $db_loginId $db_pass $db");
                        echo "<script> location.replace(\"admin_view.php\"); </script>";
                    }
                    if (isset($_POST['btn_bVorschau'])) {
                        $selectedFile = '';
                        foreach ($_POST['auswahl'] as $item) {
                            if (!empty($item)) {
                                echo "<h3>Backup vom: " . substr($item, 16, 14) . "</h3><br><br>";
                                echo "<pre>" . file_get_contents("../backup/" . $item) . "</pre>";
                                $selectedFile = $item;
                                echo "<script>
                                      document.getElementById('selectedFile').value = '$selectedFile';
                                      </script>";
                            }
                        }
                    }
                    if (isset($_POST['btn_logLaden'])) {
                        echo "<h3>Log: </h3><br><br>";
                        echo "<pre>" . file_get_contents("../log/backup-usage.txt" ) . "</pre>";
                    }
                    ?>
                </div>
                <?php
                if (isset($_POST['btn_bVorschau'])) {
                    echo '<div style="position: absolute; bottom: 0;">';
                    echo '<input type="submit" value="Backup einspielen" name="btn_bEinspielen" class="btn btn-danger" style="margin-left: 1em; margin-bottom: 1em;" />';
                    echo '</div>';
                }
                if (isset($_POST['btn_bEinspielen'])) {
                    $log = fopen("../log/backup-usage.txt", "a") or die("Unable to open file!");
                    $insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Backup eingespielt von: "  .  $_SESSION['redakteur'] . "\r";
                    fwrite($log, $insert_log);
                    fclose($log);
                    $file = "../backup/" . $_POST['selectedFile'];
                    shell_exec("/bin/bash ../backup/writeToDb.sh $db_loginId $db_pass $file");
                }
                if (isset($_POST['btn_logout'])) {
                    session_destroy();
                    echo "<script> location.replace(\"admin_login.php\"); </script>";
                }
                ?>
            </div>
        </div>
    </div>
    </form>
</body>

</html>