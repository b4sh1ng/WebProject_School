<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php
    require_once('./session_backup.inc.php');
    require("../mysql.inc.php");
    $db_loginId = $db_user;
    $db_pass = $db_pwd;
    $db = $db_name;
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <title>DB-Management</title>
</head>

<body style="background: #242424" ;>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">DB-Management</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/settings.php">Einstellungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="management.php" method="post">
                    <div class="container" style="background: #2d2d2d; margin-top: 2%; height: 90vh; width: 60vh;">
                        <div class="row">
                            <div class="col text-center" style="margin: 1em;">
                                <input type="submit" value="Backup erstellen" name="btn_bErstellen" class="btn btn-success" />
                            </div>
                            <div class="col text-center" style="margin-top: 1em;">
                                <input type="submit" value="Backup Vorschau" name="btn_bVorschau" class="btn btn-primary" />
                            </div>
                            <div class="col text-center" style="margin-top: 1em;">
                                <input type="submit" value="Log laden" name="btn_logLaden" class="btn btn-warning" />
                            </div>
                            <input type="hidden" name="selectedFile" id="selectedFile" value="" />
                        </div>
                        <div class="row">
                            <div style="height: 80vh; overflow-y: scroll; scrollbar-width: thin;">
                                <table class="table table-striped table-dark table-hover table-sm rounded" id="backup_tab" style="margin: .5em; width: 97%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Backup</th>
                                            <th>Size</th>
                                            <th>Auswahl</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $backupPath = "../backup/";
                                        $dataInPath = scandir($backupPath);
                                        $dataInPath = array_reverse($dataInPath);
                                        $iter = 1;
                                        foreach ($dataInPath as $data) {
                                            if (!preg_match("/\.(sql)$/", $data)) {
                                                continue;
                                            }
                                            $size = filesize($backupPath . $data);
                                            echo "<tr id='row " . $iter . "'>
                            <td>$iter</td>
                            <td>$data</td>
                            <td>$size Bytes</td>
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
                        </div>

                    </div>
            </div>
            <div class="col">
                <div class="container" style="background: #2d2d2d; margin-top: 1.5%; height: 90vh; width: 75vh;">
                    <div style="height: 80vh; overflow: scroll; scrollbar-width: thin;">
                        <?php
                        if (isset($_POST['btn_bErstellen'])) {
                            $log = fopen("../log/backup-usage.txt", "a") or die("Unable to open file!");
                            $insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Backup erstellt von: " .  $_SESSION['data'] . "\r";
                            fwrite($log, $insert_log);
                            fclose($log);
                            shell_exec("/bin/bash ../backup/backup.sh $db_loginId $db_pass $db");
                            echo "<script> location.replace(\"management.php\"); </script>";
                        }
                        if (isset($_POST['btn_bVorschau'])) {
                            $selectedFile = '';
                            foreach ($_POST['auswahl'] as $item) {
                                if (!empty($item)) {
                                    echo "<h3 style=\"margin-top: 1em;\">Backup vom: " . substr($item, 16, 14) . "</h3><br><br>";
                                    echo "<pre>" . file_get_contents("../backup/" . $item) . "</pre>";
                                    $selectedFile = $item;
                                    echo "<script>
                                      document.getElementById('selectedFile').value = '$selectedFile';
                                      </script>";
                                }
                            }
                            if ($selectedFile != '') {
                                echo '<div>';
                                echo '<input type="submit" value="Backup einspielen" name="btn_bEinspielen" class="btn btn-danger"/>';
                                echo '</div>';
                            }
                        }
                        if (isset($_POST['btn_logLaden'])) {
                            echo "<h3 style=\"margin-top: 1em;\">Log: </h3><br><br>";
                            echo "<pre>" . file_get_contents("../log/backup-usage.txt") . "</pre>";
                        }
                        if (isset($_POST['btn_bEinspielen'])) {
                            $log = fopen("../log/backup-usage.txt", "a") or die("Unable to open file!");
                            $insert_log = "[" . date('Y-m-d H:i:s') . "]" . "Backup eingespielt von: "  .  $_SESSION['data'] . "\r";
                            fwrite($log, $insert_log);
                            fclose($log);
                            $file = "../backup/" . $_POST['selectedFile'];
                            shell_exec("/bin/bash ../backup/writeToDb.sh $db_loginId $db_pass $file");
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </form>
</body>

</html>