<?php
namespace app\modules\v1\controllers;

use common\models\PaymentLog;

use Yii;
class SubscriptionController extends ApiController{
    
    public function actionIndex(){
        $payments = PaymentLog::find()->where(["user_id" => Yii::$app->user->id])
                        ->with(["user","log"])->all();
        
        $regMonth    =   date('Ym', Yii::$app->user->Identity->created_at);
        $curYear     =   date('Y');   
        
    }
    
}