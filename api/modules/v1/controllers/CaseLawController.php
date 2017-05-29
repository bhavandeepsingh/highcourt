<?php
namespace app\modules\v1\controllers;
use Yii;
use common\models\CaseLawSearch;
class CaseLawController extends ApiController{
    
    public function actionList(){   
        return $this->dataProvider(CaseLawSearch::getApiList(Yii::$app->request->post(), $this->loginId(), true));
    }
    
     public function actionRead(){        
        $case_id = \Yii::$app->request->post('CaseLaw');
        $case_id = (isset($case_id['id']))? $case_id['id']: $case_id;
        if(!$this->loginId()) return $this->errorLoginRequierd();
        return $this->success(["case_id" => \common\models\CaseLawStatus::markRead($case_id, $this->loginId())]);
    }
    
    public function actionUnReadCount(){        
        return $this->success(["un_read_count" => \common\models\CaseLawStatus::getUnReadCountApi(\Yii::$app->request->post(),$this->loginId(),true)]);
    }
    
}
