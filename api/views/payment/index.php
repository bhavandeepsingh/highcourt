<?php error_reporting(0); include(__DIR__."/../../../NON_SEAMLESS_KIT/Crypto.php"); ?>
<html>
    <head>
        <title> Non-Seamless-kit</title>
    </head>
    <body>
        <center>
            <?php
                $merchant_data = "";
                foreach ($params as $key => $value){
                        $merchant_data.=$key.'='.$value.'&';
                }
                $encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
            ?>
            <!--<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">--> 
            <form method="post" name="redirect" action="http://localhost/court/api/web/payment/success">
                <?= \yii\helpers\Html::csrfMetaTags() ?>
                <?php
                    echo "<input type=hidden name=encRequest value=$encrypted_data>";
                    echo "<input type=hidden name=access_code value=$access_code>";
                ?>
            </form>
        </center>
        <script language='javascript'>document.redirect.submit();</script>
    </body>
</html>