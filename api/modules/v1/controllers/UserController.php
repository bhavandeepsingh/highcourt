<?php
namespace app\modules\v1\controllers;

use Yii;

class UserController extends ApiController{
    
    public function actionLogin(){           
    	//return $this->success(['user' => @\common\models\User::find()->andWhere(['id' => 1])->one()->profile]);
        $login = new \common\models\LoginForm();
        $login->load(Yii::$app->request->post());        
        if($login->laywerLogin()){
            return $this->success(['user' => $login->getProfileArray()]);
        }else{
            return $this->error(['error' => $login->getFirstError('password')]);
        }        
    }
    
    public function actionResetPassword(){
        if(!$this->loginId()) return $this->errorLoginRequierd();            
        $model = new \common\models\PasswordResetForm($this->login_user);
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            return $this->success(['passwordReset' => $model->resetPassword()]);
        }
        return $this->error(['error' => $model->getFirstError('old_password')]);
    }
    
    
    public function actionRequestResetPassword(){        
        $model = new \common\models\RequestResetPassword();
        $model->load(Yii::$app->request->post());
        if($model->validate()){            
            return $this->success(['requestSend' => $model->requestSend()]);
        }        
        return $this->error(['license_no' => $model->getFirstError('license_no')]);
    }

    public function actionBloodGroupList(){
        return $this->success(['list' => \common\models\BloodGroups::find()->all()]);
    }
    

    public function actionExecutive(){
        return $this->dataProvider(\common\models\ProfileSearch::getApiList(Yii::$app->request->post(), null, true));
    }


}