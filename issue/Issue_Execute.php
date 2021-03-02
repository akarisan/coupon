<?php
require_once('../function/Function.php');

//変数
$ad_id = $_COOKIE['id'];

//受け取り
session_start();
$_SESSION = $_POST;
$coupon_title = $_SESSION['coupon-title'];
$coupon_limit = $_SESSION['coupon-limit'];
$coupon_list = $_SESSION['coupon-list'];
$coupon_status = $_SESSION['coupon-status'];


//ID指定
$coupon_ad_id = random_int(100000,999999);


//メーリスを探す
$mailing_select_sql = "SELECT email FROM mailing WHERE listid LIKE '%{$coupon_list}%'";
$mailing_select_stmt = $con->prepare($mailing_select_sql);
$mailing_select_stmt->execute();
$mailing_select_count = 0;
$coupon_mailing_arr = array();


while($mailing_select_res = $mailing_select_stmt->fetch(PDO::FETCH_ASSOC)){
    $coupon_id = random_int(1000,9999)."-".random_int(1000,9999)."-".random_int(1000,9999);
    $coupon_mail = $mailing_select_res['email'];
    //$coupon_ad_id
    
    //配列化
    $coupon_arr = array($coupon_id,$coupon_mail,$coupon_ad_id);
    array_push($coupon_mailing_arr,$coupon_arr);
    
    $mailing_select_count++;
}
if($mailing_select_count == 0){
    header("Location: https://lo-ope.com/cp/cp-ad/");
    exit();
}


//couponに挿入・メール送信
$coupon_insert_sql = "INSERT INTO coupon (cpid,usmail,cpadid) VALUES (:cpid,:usmail,:cpadid)";
$coupon_insert_stmt = $con->prepare($coupon_insert_sql);
foreach($coupon_mailing_arr as $coupon_mailing_row){
    $coupon_insert_stmt->bindParam(':cpid',$coupon_mailing_row[0],PDO::PARAM_STR);
    $coupon_insert_stmt->bindParam(':usmail',$coupon_mailing_row[1],PDO::PARAM_STR);
    $coupon_insert_stmt->bindValue(':cpadid',$coupon_mailing_row[2],PDO::PARAM_INT);
    $coupon_insert_stmt->execute();
    
    //メール送信
    $sdml_title = "【CouPon!】クーポン発行のお知らせ";
    $sdml_body =<<<HTML
Coupon!

あなたの登録されているメーリングリストより、クーポンが発行されました。

{$coupon_title}
【{$coupon_mailing_row[0]}】


こちらより、クーポンを使用できます。
https://lo-ope.com/cp/?c={$coupon_mailing_row[0]}

Copyright(c)Coupon!
HTML;
    sdml($coupon_mailing_row[1],$sdml_title,$sdml_body);
}


//couponlistに挿入
$couponlist_insert_sql = "INSERT INTO couponlist (cpnm,cpadid,limitday,adid,cpstatus) VALUES ('$coupon_title','$coupon_ad_id','$coupon_limit','$ad_id','$coupon_status')";
$couponlist_insert_stmt = $con->prepare($couponlist_insert_sql);
$couponlist_insert_stmt->execute();

print "<script>alert('クーポンを発行しました。');document.location.href='https://lo-ope.com/cp/cp-ad/';</script>";
exit();


?>