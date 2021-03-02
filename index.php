<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CouPon!</title>
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="skeleton.css">
    </head>
    <body>
        <hr class="brand-banner">
        <div class="container">
            <a class="button" href="cp-ad/">sine in</a>
            <a class="button" href="#regist">registration</a>
            <h1>CouPon!</h1>
        </div>
        
        <!--クーポン番号入力-->
        <div class="container">
            <div>
                <label for="coupon-id">クーポン番号</label>
                    <input type="text" class="u-full-width" id="coupon-id" value="<?php print $_GET['c']; ?>">
            </div>
            <div style="text-align: center" id="qr-issue-submit">
                <button class="button-primary button-large" onclick="QRIssue();">issue</button>
            </div>
        </div>
        
        <!--QRコード表示-->
        <div class="container">
            <div id="cp-qr-display"></div>
        </div>
        
        <!--説明文-->        
        <!--特徴-->
        <hr>
        <div class="container row">
            <div class="four columns">
                <hr class="brand-banner">
                <h2>Smart</h2>
                <p>管理画面を立ち上げて、5秒で<b>ポンッ</b>と発行完了。</p>
            </div>
            
            <div class="four columns">
                <hr class="brand-banner">
                <h2>Simple</h2>
                <p>ボタン1つでクーポンを一斉送信。期限付きで送れるから、キャンペーン利用に最適。</p>
            </div>
            
            <div class="four columns">
                <hr class="brand-banner">
                <h2>Secure</h2>
                <p>送られたクーポンは固有のIDで区別され、クーポンの不正利用を防止。</p>
            </div>
        </div>
        
        
        <!--プラン表-->
        <hr>
        <div class="container row" id="regist">
            <div class="six columns">
                <hr class="brand-banner">
                <h2>Free Plan</h2>
                <ul>
                    <li>Issue only 1 coupon.</li>
                    <li>Up to 15 people can be distributed.</li>
                    <li>Can't use coupon with deadline.</li>
                    <li>¥0 / year</li>
                </ul>
                <button class="button">registration</button>
            </div>
            
            <div class="six columns">
                <hr class="brand-banner">
                <h2>Pro Plan</h2>
                <ul>
                    <li>Issue up to 10 coupon.</li>
                    <li>Up to 300 people can be distributed.</li>
                    <li>Can use coupon with deadline.</li>
                    <li>¥10,000 / year</li>
                </ul>
                <button class="button">resistration</button>
            </div>
        </div>
        
        <!--お問い合わせ-->
        <hr>
        <div class="container row">
            <form method="post" action="contact/Contact_Sendmail.php">
                <!--名前-->
                <div class="six columns">
                    <label for="contact-name">Name</label>
                    <input type="text" id="contact-name" name="contact-name" class="u-full-width" placeholder="山田太郎　／　Taro Yamada">
                </div>
                
                <!--メール-->
                <div class="six columns">
                    <label for="contact-mail">your Email</label>
                    <input type="email" id="contact-mail" name="contact-mail" class="u-full-width" placeholder="example@lo-ope.com">
                </div>
                
                <!--内容-->
                <label for="contact-content">Message</label>
                <textarea id="contact-content" name="contact-name" class="u-full-width" placeholder="Hi, I'm Taro..."></textarea>
                
                <!--送信ボタン-->
                <input type="submit" class="button-primary" value="submit">
            </form>
        </div>
        
        <!--フッター-->
        <hr>
        <div class="container">
            <p>&copy;Akari All Rights Reserved.</p>
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/qrcode.min.js"></script>
        <script>
            function QRIssue(){
                document.getElementById("qr-issue-submit").textContent = null;
                var QRvalue = document.getElementById("coupon-id").value;
                new QRCode(document.getElementById("cp-qr-display"),QRvalue);
            }
        </script>
    </body>
</html>