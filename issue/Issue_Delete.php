<?php
//ログインチェック・DB接続
require_once('../function/Function.php');

//変数
$ad_id = $_COOKIE['id'];

//受け取り
session_start();
$_SESSION = $_GET;
$coupon_ad_id = ch($_SESSION['d']);

$con->query("DELETE FROM coupon WHERE cpadid = '$coupon_ad_id'");
$con->query("DELETE FROM couponlist WHERE cpadid = '$coupon_ad_id'");

header("Location: https://lo-ope.com/cp/cp-ad/");
exit();
?>