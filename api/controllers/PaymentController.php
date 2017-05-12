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
    protected $access_code = 'AVEI70EE66AS85IESA';//Shared by CCAVENUES
    protected $working_key = 'BF0E1C147318F719F0C6E7CF49A56C47';//Shared by CCAVENUES
    
    public function actionIndex()
    {
        $req = Yii::$app->request;
        //if(!$req->post("user_id")){ return "Invalid User ID."; die;}
        //if(empty($req->post("amount"))){ return "Please Enter a valid amount."; die;}
        $profile = Profile::find()->where(["user_id" => 1])->one();//$req->post("user_id")
        $payment = new PaymentLog();
        $payment->user_id           =   1;//$req->post("user_id");
        $payment->amount            =   1;//$req->post("amount");
        $payment->payment_type      =   1;
        $payment->status            =   PaymentLog::$INIT;//$req->post("payment_type");
        $payment->save();
        
        
        $data = [
            'access_code'   =>  $this->access_code,
            'working_key'   =>  $this->working_key,
            'params'        =>  [
                //necessary
                //"tid"		=>	"",
                "merchant_id"           =>      $this->merchant_id,
                "order_id"		=>	"CHB00".$payment->id,
                "currency"		=>	"INR",
                "amount"		=>	$payment->amount,
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
        include(__DIR__."/../../NON_SEAMLESS_KIT/Crypto.php");
    	$req = Yii::$app->request;
        
        $encResponse=$req->post("encResp");			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse, $this->working_key);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	
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
    }
    
    public function Success($res){
        $this->savePaymentStatus($res, PaymentLog::$SUCCESS);
    }
    
    public function savePaymentStatus($res,$status){
        $payment_id = $this->getPaymentId($res);
        $payment = PaymentLog::find()->where(["id" => $payment_id])->one();
        $resArray = $this->getResultArray($res);
        if($payment){
            $payment->response = json_encode($resArray);
            $payment->status = $status;
            $payment->save();
            echo json_encode(PaymentLog::getUserLog(\common\models\User::find()->where(["id" => $payment->user_id])->one()));
        }
        die;
    }
    
    public function getPaymentId($res){
        $order_id   = explode("=",$res[0]);
        return str_replace("CHB00", "", $order_id[1]);
    }
    
    public function getResultArray($res){
        $resArray = [];
        foreach($res as $key => $value){
            $data = explode("=", $value);
            $resArray[$data[0]] = $data[1];
        }
        return $resArray;
    }
        
    public function Aborted($res){
        $this->savePaymentStatus($res, PaymentLog::$ABORT);
    }
    
    public function Failure($res){
        $this->savePaymentStatus($res, PaymentLog::$FAILURE);
    }
    
    public function Illegal($res){
        $this->savePaymentStatus($res, PaymentLog::$ILLEGAL);
    }
    
    public function actionCancel()
    {
        $this->savePaymentStatus($res, PaymentLog::$CANCEL);
    }

}