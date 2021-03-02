<?php
#$user_issue クーポンの数
#$user_resister メール登録数
/*
<div class='six columns'><hr class='brand-banner'><h5>{$coupon_list_res['cpnm']}</h5><p>Limit：{date("Y年m月d日",$coupon_list_res['limitday])}</p><a class='button' href='issue/Issue_Delete.php?d='>delete</a></div>
*/

/*
<div class='six columns'><h5>メーリス名</h5><a href='../mail/Mail_List_Edit.php?m=' class='button'>edit</a><a href='../mail/Mail_List_Delete.php?d=' class='button'>delete</a></div>
*/

//クーポン
$ad_id = $_COOKIE['id'];    #管理者ID
$user_issue = 0;    #クーポン数カウント
$coupon_list_print = "";

$coupon_list_sql = "SELECT testfor,cpnm,cpadid,limitday FROM couponlist WHERE adid = '$ad_id'";
$coupon_list_stmt = $con->prepare($coupon_list_sql);
$coupon_list_stmt->execute();

while($coupon_list_res = $coupon_list_stmt->fetch(PDO::FETCH_ASSOC)){
    //UNIXStamp conversion
    $coupon_limit = $coupon_list_res['limitday'];
    
    //html発行
    $coupon_ad_id = $coupon_list_res['cpadid'];
    $coupon_list_print =  $coupon_list_print."<div class='six columns'><hr class='brand-banner'><h5>{$coupon_list_res['cpnm']}</h5><p>Limit：{$coupon_limit}</p><a class='button' onclick=\"if(confirm('クーポンを削除しますか？')){document.location.href='../issue/Issue_Delete.php?d={$coupon_ad_id}'};\">delete</a></div>";
    
    $user_issue++;
}

//メーリス
$user_resister = 0; #メール登録数カウント
$mailing_list_print = "";

$mailing_list_sql = "SELECT listnm,listid FROM mailinglist WHERE adid = '$ad_id'";
$mailing_list_stmt = $con->prepare($mailing_list_sql);
$mailing_list_stmt->execute();

while($mailing_list_res = $mailing_list_stmt->fetch(PDO::FETCH_ASSOC)){
    $mailing_list_print = $mailing_list_print."<div class='six columns'><h5>{$mailing_list_res['listnm']}</h5><a href='../mail/Mail_List_Edit.php?m={$mailing_list_res['listid']}' class='button button-primary'>edit</a><a href='../mail/Mail_List_Delete.php?d={$mailing_list_res['listid']}' class='button'>delete</a></div>";
    $mailing_list_option = $mailing_list_option."<option value='{$mailing_list_res['listid']}'>{$mailing_list_res['listnm']}</option>";
}

//メール登録数のチェック
$mailing_count_sql = "SELECT COUNT(*) FROM mailing WHERE adid = '$ad_id'";
$mailing_count_stmt = $con->prepare($mailing_count_sql);
$mailing_count_stmt->execute();
$user_resister = $mailing_count_stmt->fetchColumn();
?>