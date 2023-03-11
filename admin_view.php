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
                <table class="table table-striped table-dark table-hover table-sm rounded">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Log Datum</th>
                            <th>Dateigröße</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>10.03.2023 10:45</td>
                            <td>20kb</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>10.03.2023 10:45</td>
                            <td>11kb</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="button-container">
                <form action="admin_view.php">

                    <input type="submit" value="Backup erstellen" name="btn_bCreate" class="btn btn-success" style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="submit" value="Backup Vorschau" name="btn_bView" class="btn btn-primary" style="margin-left: 1em; margin-bottom: 1em;" />
                    <input type="submit" value="Log laden" name="btn_lView" class="btn btn-warning" style="margin-left: 1em; margin-bottom: 1em;" />

                </form>
            </div>
        </div>
        <div class="rightDiv">
            <!--Preview hier einfügen-->
            <div style="margin: 5px;">
                <h1 style="margin: 5px;">Vorschau</h1>
                <div class="scroll-view" style="margin: 3em; background-color: grey;">
                    <?php
                    /* if(btn_bView == true && backupSelected())
                        {
                            loadSelectedBackupView();
                        }
                        elif(btn_bView == true)
                        {
                            loadLatedBackupView();
                        }
                        elif(btn_blView == true)
                        {
                            loadLogView();
                        }
                    */
                    echo file_get_contents("/home/bash/Documents/vscode/webproj/weprori/backups/test_backup.sql");
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>