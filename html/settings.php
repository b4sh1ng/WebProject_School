<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <title>Einstellungen</title>
</head>

<body style="background: #242424" ;>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">DB-Management</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="management.php">Zurück</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="container-fluid shadow p-3 mb-5 rounded" style="background-color: #2d2d2d; height: 10em; width: 30em;">
            <h1 class="display-6">Einstellungen</h1>
            <br>
            <form action="settings.php" method="post">
                <?php
                //session_start();
                $fakey = $_SESSION['key'];
                if (!($fakey == NULL)) {
                    echo '<button type="submit" class="btn btn-danger" name="btn_no_2fa">2FA Deaktivieren</button>';
                } else {
                    echo '<button type="submit" class="btn btn-success" name="btn_2fa">2FA Aktivieren</button>';
                }
                if (isset($_POST['btn_2fa'])) {
                    $user = $_SESSION['data'];
                    $_SESSION['key'] = "activated";
                    shell_exec("/bin/bash ../2fakey/create_activate_2fa.sh $user $db_loginId $db_pass $db");
                    echo "<script> location.replace(\"2fa_view.php\"); </script>";
                }
                if (isset($_POST['btn_no_2fa'])) {
                    $user = $_SESSION['data'];
                    $_SESSION['key'] = NULL;
                    shell_exec("/bin/bash ../2fakey/deactivate_2fa.sh $user $db_loginId $db_pass $db");
                    echo "<script> location.replace(\"settings.php\"); </script>";
                }
                ?>
        </div>
    </div>
    </form>
</body>

</html>