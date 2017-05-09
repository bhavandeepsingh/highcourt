<?php

namespace api\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\PaymentLog;
use common\models\Profile;

class PaymentController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;
    
    protected $merchant_id = '131798';
    protected $access_code = 'AVVI70ED44CC60IVCC';//Shared by CCAVENUES
    protected $working_key = '9859EA98A108D305C1EB7DA60B03EA23';//Shared by CCAVENUES
    
    public function actionIndex()
    {
        //return $this->redirect(\yii\helpers\Url::to("success"));die;
        $req = Yii::$app->request;
        if(!$req->post("user_id")){ return "Invalid User ID."; die;}
        if(empty($req->post("amount"))){ return "Please Enter a valid amount."; die;}
        $payment = new PaymentLog();
        $payment->user_id           =   $req->post("user_id");
        $payment->amount            =   $req->post("amount");
        $payment->payment_type      =   1;
        $payment->status            =   PaymentLog::$INIT;//$req->post("payment_type");
        $payment->save();
        
        $profile = Profile::find(1)->one();//$req->post("user_id")
        $data = [
            'access_code'   =>  $this->access_code,
            'working_key'   =>  $this->working_key,
            'params'        =>  [
                //necessary
                //"tid"		=>	"",
                "merchant_id"           =>      $this->merchant_id,
                "order_id"		=>	"CHB00".$payment->id,
                "currency"		=>	"INR",
                "amount"		=>	200,
                "language"		=>	"EN",
                "redirect_url"          =>	\yii\helpers\Url::toRoute("success",true),
                "cancel_url"            =>	\yii\helpers\Url::toRoute("cancel",true),
                //"SUB-MERCHANT TEST" => 1,
                // optional
                "billing_name"      =>      @$profile->name,
                "billing_address"   =>      @$profile->residential_address,
                //"billing_city"      =>      "",
                //"billing_state"     =>      "",
                //"billing_zip"       =>      "",
                //"billing_country"   =>      "India",
                "billing_tel"       =>      @$profile->mobile,
                "billing_email"     =>      @$profile->public_email,
            ]
        ];
        return $this->render("index", $data);
    }
    
    public function actionSuccess()
    {
        include(__DIR__."/../../../NON_SEAMLESS_KIT/Crypto.php");
    	$req = Yii::$app->request;
        
        //$encResponse=$req->post("encResp");			//This is the response sent by the CCAvenue Server
	$encResponse=$req->post("encRequest");
        $rcvdString=decrypt($encResponse, $this->working_key);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	
        echo "<center>";
        
        for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}
        
        switch ($order_status){
            case "Success": $this->Success($decryptValues); break;
            case "Aborted": $this->Aborted($decryptValues); break;
            case "Failure": $this->Failure($decryptValues); break;
            default: $this->Illegal($decryptValues); break;
        }
        
	echo "<br><br>";
	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
            $information=explode('=',$decryptValues[$i]);
            if($information[0] == "language" || $information[0] == "redirect_url" || $information[0] == "cancel_url") continue;
            echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	}
	echo "</table><br>";
	echo "</center>";
        
        //require(__DIR__."/../../../NON_SEAMLESS_KIT/ccavRequestHandler.php");
    }
    
    public function Success($res){
//        $order_id   = explode("=",$res[0]);
//        $payment_id = str_replace("CHB00", "", $order_id[1]);
//        $payment = PaymentLog::find($payment_id)->one();
//        $payment->status = PaymentLog::$SUCCESS;
//        $payment->save();
        echo "<br>Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
    }
    
    public function Aborted($res){
        echo "<br>We will keep you posted regarding the status of your order through e-mail";
    }
    
    public function Failure($res){
        echo "<br>The transaction has been declined.";
    }
    
    public function Illegal($res){
        echo "<br>Security Error. Illegal access detected";
    }
    
    public function actionCancel()
    {
        echo "Your Order has been cancelled successfully";
    	//require(__DIR__."/../../../NON_SEAMLESS_KIT/ccavRequestHandler.php");
    }

}
