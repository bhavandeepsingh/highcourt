<?php
namespace app\modules\v1\controllers;


use Yii;

use common\models\RosterSearch;
class RosterController extends ApiController{
    
    public function actionList(){
        //echo 'qwe';die;
        return $this->dataProvider(RosterSearch::getApiList(Yii::$app->request->post(), null, true));
    }
    
}