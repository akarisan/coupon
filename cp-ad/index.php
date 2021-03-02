<?php
require_once('../function/Function_Check.php');
require_once('../issue/Issue_List.php');
require_once('../issue/Issue_Check.php');
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CouPon!-管理画面</title>
        <link rel="stylesheet" href="../normalize.css">
        <link rel="stylesheet" href="../skeleton.css">
    </head>
    <body>
        <hr class="brand-banner">
        <div class="container">
            <h1 onclick="document.location.href='../';">CouPon!</h1>
        </div>
        
        <div class="container">
            <a href="reader.html" class="u-full-width button">Coupon Reader</a>
        </div>
        
        <!--管理者情報-->
        <hr>
        <div class="container">
            <!--基本情報-->
            <table class="u-full-width">
                <thead>
                    <tr>
                        <th>Name(Company)</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php print $user_name; ?></td>
                        <td><?php print $user_mail; ?></td>
                    </tr>
                </tbody>
            </table>
            
            <!--詳細情報-->
            <table class="u-full-width">
                <thead>
                    <tr>
                        <th>Issues</th>
                        <th>Register</th>
                        <th>Plan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php print $user_issue; ?> coupon</td>
                        <td><?php print $user_resister; ?> people</td>
                        <td><?php print $user_plan; ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="../login/" class="button">別のアカウントを使う</a>
        </div>
        
        <!--クーポン発行-->
        <div class="container">
            <h2>Issue</h2>
            <form method="post" action="../issue/Issue_Execute.php">
                <?php print $issue_check_print; ?>
            </form>
        </div>
        
        <!--発行したクーポンリスト-->
        <div class="container">
            <h2>Coupon</h2>
            <div class="row">
                <?php print $coupon_list_print; ?>
            </div>
        </div>
        
        <!--メーリングリスト-->
        <div class="container">
            <h2>Mailing List</h2>
            <div class="row">
                <?php print $mailing_list_print; ?>
            </div>
        </div>
        
        <!--フッター-->
        <hr>
        <div class="container">
            <p>&copy;Akari All Rights Reserved.</p>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </body>
</html>