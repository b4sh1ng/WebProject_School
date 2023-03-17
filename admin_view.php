<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin_view.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>BackUp | Manager</title>
</head>

<body style="background-color:#3b3b3b">
    <div class="outerDiv">
        <div class="leftDiv">
            <h3 style="margin: 5px;">Backup Liste</h3>
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
                        $backupPath = "/home/dotto/backup/";
                        $dataInPath = scandir($backupPath);
                        $dataInPath = array_reverse($dataInPath);
                        $iter = 1;
                        foreach ($dataInPath as $data) {
                            if ($data == "." || $data == ".." || $data == "backup.sh") {
                                continue;
                            }
                            echo "<tr id='row " . $iter . "'>
                            <td>$iter</td>
                            <td>$data</td>
                            <td ><input style='margin-left: 25px;' type='checkbox'/></td>
                            </tr>";
                            $iter = $iter + 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="button-container">
                <form action="admin_view.php" method="post">

                    <input type="submit" value="Backup erstellen" name="btn_Submit" class="btn btn-success" style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="button" value="Backup Vorschau" onclick="GetSelected()" name="btn_Submit" class="btn btn-primary" style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="submit" value="Log laden" name="btn_Submit" class="btn btn-warning" style="margin-left: 1em; margin-bottom: 1em;" />

                </form>
            </div>
        </div>
        <div class="rightDiv">
            <div style="margin: 5px;">
                <h1 style="margin: 5px;">Vorschau</h1>
                <div class="scroll-view" style="margin: 3em; background-color: grey;">
                    <?php
                    if (isset($_POST['btn_Submit'])) {
                        shell_exec('/bin/bash /home/dotto/backup/backup.sh');
                        echo '<script>alert("Backup erstellt!");</script>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>