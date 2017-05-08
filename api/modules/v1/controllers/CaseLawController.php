<?php
namespace app\modules\v1\controllers;
use Yii;
use common\models\CaseLawSearch;
class CaseLawController extends ApiController{
    
    public function actionList(){
   
        return $this->dataProvider(CaseLawSearch::getApiList(Yii::$app->request->post(), null, true));
    }
    
}
