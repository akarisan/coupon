<?php
require_once('../function/Function.php');

session_start();

$_SESSION = $_POST;
$ct_nm = $_SESSION['contact-name'];
$ct_ml = $_SESSION['contact-mail'];
$ct_cont = ch($_SESSION['contact-content']);

//メール送信
$title = "【お問い合わせ】CouPon!から";
$body =<<<HTML
{$ct_nm}様より

【内容】
{$ct_cont}

Copyright(c)Akari 2015-2018
HTML;
sdml($ct_ml,$title,$body);

header("Location: https://lo-ope.com/cp/");
?>