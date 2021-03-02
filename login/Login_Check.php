<?php
require_once('../function/Function.php');

session_start();

$_SESSION = $_POST;
$user_mail = $_SESSION['user-mail'];
$user_pass = $_SESSION['user-pass'];

//sql代入
$login_sql = "SELECT * FROM login WHERE admail = '$user_mail'";
$login_stmt = $con->query($login_sql);

 
// foreach文で配列の中身を一行ずつ出力
foreach($login_stmt as $login_row){
  $user_true_pass = $login_row['adpass'];
  $user_id = $login_row['testfor'];
  $user_plan = $login_row['plan'];
  $user_name = $login_row['adnm'];
}

if($user_pass !== $user_true_pass){
    header("Location: https://lo-ope.com/cp/login/");
    exit();
}else{
    setcookie("mail",$user_mail,time()+60*60*24*7,'/cp/','lo-ope.com');
    setcookie("pass",$user_pass,time()+60*60*24*7,'/cp/','lo-ope.com');
    setcookie("id",$user_id,time()+60*60*24*7,'/cp/','lo-ope.com');
    header("Location: https://lo-ope.com/cp/cp-ad/");
    exit();
}

?>