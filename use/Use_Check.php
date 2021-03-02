<?php
require_once('../function/Function.php');

session_start();
$_SESSION = $_GET;
$cp_id = $_SESSION['qr'];

//couponからselect
$use_check_sql = "SELECT cpadid FROM coupon WHERE cpid = '{$cp_id}'";
$use_check_stmt = $con->prepare($use_check_sql);
$use_check_stmt->execute();


while($use_check_res = $use_check_stmt->fetch(PDO::FETCH_ASSOC)){
    $cp_ad_id = $use_check_res['cpadid'];
}

if($cp_ad_id != null){
    //couponlistからselect
    $couponlist_sql = "SELECT cpnm FROM couponlist WHERE cpadid = '$cp_ad_id'";
    $couponlist_stmt = $con->prepare($couponlist_sql);
    $couponlist_stmt->execute();
    
    while($couponlist_res = $couponlist_stmt->fetch(PDO::FETCH_ASSOC)){
        $cp_nm = $couponlist_res['cpnm'];
        $cp_st = $couponlist_res['cpstatus'];
    }
    $cp_state = "使用可能";
    $cp_btn = "<button class=\"button-primary\" onclick=\"document.location.href='https://lo-ope.com/cp/use/Use_Execute.php?c={$cp_id}&s={$cp_st}';\">use coupon</button>";
}else{
    $cp_nm = "不明なクーポン";
    $cp_id = "????";
    $cp_state = "使用不可";
    $cp_btn = "<button onclick=\"document.location.href='https://lo-ope.com/cp/cp-ad/reader.html';\">cancel</button>";
}


?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CouPon!-チェック</title>
        <link rel="stylesheet" href="../normalize.css">
        <link rel="stylesheet" href="../skeleton.css">
    </head>
    <body>
        <hr class="brand-banner">
        <div class="container">
            <h1 onclick="document.location.href='../';">CouPon!</h1>
        </div>
        
        <div class="container">
            <h2>Detail</h2>
            <table class="u-full-width">
                <tbody>
                    <tr>
                        <th>クーポン名</th>
                        <td><?php print $cp_nm; ?></td>
                    </tr>
                    <tr>
                        <th>クーポン番号</th>
                        <td><?php print $cp_id; ?></td>
                    </tr>
                    <tr>
                        <th>状態</th>
                        <td><?php print $cp_state; ?></td>
                    </tr>
                </tbody>
            </table>
            
            <?php print $cp_btn; ?>
        </div>
        
        
    </body>
</html>