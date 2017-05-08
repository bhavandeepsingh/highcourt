<?php
namespace app\modules\v1\controllers;

use Yii;
use common\models\JudgesSearch;

class JudgesController extends ApiController{
    
    public function actionList(){ 
        
        return $this->dataProvider(JudgesSearch::getApiList(Yii::$app->request->post(), null, true));
    }
    
}