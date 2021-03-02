<?php
require_once('../function/Function.php');

session_start();
$_SESSION = $_GET;
$cp_id = $_SESSION['c'];
$cp_st = $_SESSION['s'];

if($cp_st == "once"){
    /*1回しか使えない*/
    $con->query("DELETE FROM coupon WHERE cpid = '{$cp_id}'");
}else{
    /*無限に使える*/
}

print "<script>alert('クーポンを使用しました。');document.location.href='https://lo-ope.com/cp/cp-ad/reader.html';</script>";

exit();
?>