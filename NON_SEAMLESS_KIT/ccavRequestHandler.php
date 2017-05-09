<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php') ?>
<?php 

	error_reporting(0);
	echo "est";
        die();
	$merchant_data='131798';
	$access_code='AVVI70ED44CC60IVCC';//Shared by CCAVENUES
	$working_key='9859EA98A108D305C1EB7DA60B03EA23';//Shared by CCAVENUES

	// $arr=[
	// 	"order_id"		=>	"CHB0001",
	// 	"currency"		=>	"INR",
	// 	"currency"		=>	200,
	// 	"language"		=>	"en",
	// 	"redirect_url"	=>	"http://www.squareloops.com/success",
	// 	"cancel_url"	=>	"http://www.squareloops.com/cancel",
	// 	"SUB-MERCHANT TEST" => 1,
	// ];

	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

