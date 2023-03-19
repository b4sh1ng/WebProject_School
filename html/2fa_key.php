<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>2FA KEY</title>
</head>

<body>
    <div class="d-flex justify-content-center">
        <h3>Dein 2FA Key</h3>
        <br>
        <div>
            <img src="2fakey/2fa_key.png">
        </div>
        <form method="post">
            <input class="btn btn-success" type="submit" value="Go back!" name="btn_back">
            <?php

            if (isset($_POST['btn_back'])) {
                unlink("2fakey/2fa_key.png");
                echo "<script> location.replace(\"admin_view.php\"); </script>";
            } ?>
        </form>
    </div>
</body>

</html>