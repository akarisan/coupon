<?php
//変数設定
$ad_id = $_COOKIE['id'];    #管理者ID
//$user_plan
//$user_issue
/*
<div class='row'><div class='six columns'><label for='coupon-title'>COUPON NAME</label><input type='text' id='coupon-title' name='coupon-title' class='u-full-width'></div><div class='six columns'><label for='coupon-limit'>LIMIT DAY</label><input type='date' id='coupon-limit' name='coupon-limit' class='u-full-width'></div></div><div><label for='coupon-lis'>MAILING LIST</label><select id='coupon-list' name='coupon-list' class='u-full-width'><?php print $mailing_list_option; ?></select></div><input type='submit' value='confirm' class='button-primary'>
*/

//プラン選択
if($user_plan === "free"){
    //FreePlan
    //クーポン数チェック
    if(intval($user_issue) < 1){
        $issue_check_print = "<div class='row'><div class='six columns'><label for='coupon-title'>COUPON NAME</label><input type='text' id='coupon-title' name='coupon-title' class='u-full-width'></div><div class='six columns' hidden><label for='coupon-limit'>LIMIT DAY</label><input type='date' id='coupon-limit' name='coupon-limit' class='u-full-width' readonly></div></div><div><label for='coupon-list'>MAILING LIST</label><select id='coupon-list' name='coupon-list' class='u-full-width'>{$mailing_list_option}</select></div><div><label for='coupon-status'>COUPON STATUS</label><select id='coupon-list' name='coupon-status' class='u-full-width'><option value='once'>1人1枚</option><option value='nolimit'>制限なし</option></select></div><input type='submit' value='confirm' class='button-primary'>";
    }else{
        $issue_check_print = "クーポン発行数が上限に達しています。";
    }

}else if($user_plan === "pro"){
    //ProPlan
    //クーポン数チェック
    if(intval($user_issue) < 10){
        $issue_check_print = "<div class='row'><div class='six columns'><label for='coupon-title'>COUPON NAME</label><input type='text' id='coupon-title' name='coupon-title' class='u-full-width'></div><div class='six columns'><label for='coupon-limit'>LIMIT DAY</label><input type='date' id='coupon-limit' name='coupon-limit' class='u-full-width'></div></div><div><label for='coupon-lis'>MAILING LIST</label><select id='coupon-list' name='coupon-list' class='u-full-width'>{$mailing_list_option}</select></div><div><label for='coupon-status'>COUPON STATUS</label><select id='coupon-list' name='coupon-status' class='u-full-width'><option value='once'>1人1枚</option><option value='nolimit'>制限なし</option></select></div><input type='submit' value='confirm' class='button-primary'>";
    }else{
        $issue_check_print = "クーポン発行数が上限に達しています。";
    }
    
}else{
    //エラー処理
    header("Location: https://lo-ope.com/cp/");
    exit;
}
?>