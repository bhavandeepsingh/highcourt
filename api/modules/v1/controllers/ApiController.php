<?php
namespace app\modules\v1\controllers;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class ApiController extends \yii\rest\Controller{

    public $dataprovider;
    public $login_user;
    public $header_name = "highcourt-header-token";

    public function beforeAction($action) {   
        $headers = Yii::$app->request->headers;
        if(isset($headers[$this->header_name]) && !empty($headers[$this->header_name])){                        
            if(is_numeric($headers[$this->header_name])){                
                Yii::$app->user->setIdentity(\common\models\User::findOne(["id" => $headers[$this->header_name]]));           
            }else{
                Yii::$app->user->setIdentity(\common\models\User::findOne(["auth_key" => $headers[$this->header_name]]));           
            }
            $this->login_user = Yii::$app->user->getIdentity(); 
        }              
        return parent::beforeAction($action);
    }       
    
    public function pagination(){
        if(!$this->dataprovider) throw new Exception('Please set the dataprovider before getPagination');        
        $total = $this->dataprovider->getTotalCount(); 
        $per_page = $this->dataprovider->pagination->getPageSize();        
        $load_more = false;       
        $current_page = $this->dataprovider->pagination->page+1;
        if($total && $per_page && ($total/($per_page))>$current_page){$load_more = true;}        
        return ['total' => $total, 'load_more' => $load_more, 'page_no' => $current_page];
    }
        
    public function success($data = [], $debug = false){        
        if($debug) $data = ArrayHelper::merge($data, ['debug' => $this->debug()]);        
        return ArrayHelper::merge(['is_success' => true], $data);       
    }
    
    public function error($error = []){
        if(!count($error)) return false;        
        return \yii\helpers\ArrayHelper::merge(['is_success' => false], $error);
    } 
    
    
    public function errorLoginRequierd(){
        return $this->error(['error' => 'Please set login id.']);
    }


    public function exception(Exception $e){        
        return \yii\helpers\ArrayHelper::merge(['is_success' => false], [
            'exception' => [
                'message' => $e->getMessage(),
                'code' => $e->getCode()                
            ]
        ]);
    } 
        
    public function debug(){        
        return Yii::getLogger()->getProfiling();
    }
    
    public function unAthorizeAccess(){
        throw new \yii\web\UnauthorizedHttpException('You are not allowed to performe this action.');
    }
    
    public function loginId(){
        return ($this->login_user)? $this->login_user->getId(): false;
    }
    
    public function dataProvider($dataprovider, $debug = false){
        $this->dataprovider = $dataprovider;
        return $this->success(['list' => $dataprovider->getModels(), 'pagination' => $this->pagination()], $debug); 
    }
    
    public function getErrorMessage($error){
        $message = "";
        if(is_array($error) && count($error) > 0){
            foreach($error as $v){
                $message = $v;
                break;
            }
        }
        return $message;
    }
    
}
