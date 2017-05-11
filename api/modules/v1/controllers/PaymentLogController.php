<?php
namespace app\modules\v1\controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaymentLogController
 *
 * @author bhavan
 */
class PaymentLogController extends ApiController{
    
    public function actionList(){
        if(!$this->loginId()) return $this->errorLoginRequierd();        
        return $this->success(\common\models\PaymentLog::getUserLog($this->login_user));
    }
    
}
