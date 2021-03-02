<?php
//Yes通常、Noメンテナンス中
$check = "yes";

if($check === "no"){
    header("Location: https://lo-ope.com/cp/maintenance.html");
    exit();
}

require_once('Function.php');

if (null !== $_COOKIE["id"] && null !== $_COOKIE["pass"]) {
    $user_id = intval($_COOKIE["id"]);
    $user_pass = $_COOKIE["pass"];
    
    //DBでid検索し、adnmを引き出す
    $user_page_sql = "SELECT adnm,plan,admail FROM login WHERE testfor LIKE $user_id and adpass LIKE '$user_pass'";
    $user_page_stmt = $con->query($user_page_sql);
    
    // foreach文で配列の中身を一行ずつ出力
    foreach($user_page_stmt as $user_page_row){
        $user_name = $user_page_row['adnm'];
        $user_plan = $user_page_row['plan'];
        $user_mail = $user_page_row['admail'];
    }
    if($user_name !== null){
    }else{
        header("Location: https://lo-ope.com/cp/login/");
        exit();
    }
}else{
    header("Location: https://lo-ope.com/cp/login/");
    exit();
}
?>