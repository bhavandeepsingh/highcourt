<?php
namespace app\modules\v1\controllers;

use Yii;
use common\models\RosterSearch;
class RostersController extends ApiController{
    
    public function actionList(){
       // print_r("abc");die;
        return $this->dataProvider(RosterSearch::getApiList(Yii::$app->request->post(), null, true));
    }
}

