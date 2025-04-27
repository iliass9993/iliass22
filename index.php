<?php
include 'header.php';
include 'db.php';
session_start();
$mypage = $_GET['page'] ?? 'home';
$email = "";
$_SESSION['email'] ??= "";
switch ($mypage) {
    case "login":
        @include("login.php");
        break;

    case "payment":
        @include "payment.php";
        break;

    case "plans":
        @include "payment.php";
        break;

    default:
        @include "home.php";
}
echo $_SESSION['email'];
include 'footer.php';
