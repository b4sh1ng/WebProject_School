<?php
session_start();
if(empty($_SESSION['data']))
{
    session_destroy();
    die("<a href='./admin_login.php' > [Bitte melden Sie sich zunächst an.]</a><br><br>");
}