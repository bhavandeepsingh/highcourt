<?php
namespace app\modules\v1\controllers;

use Yii;
use common\models\ProfileSearch;
class ProfileController extends ApiController{
    
    public function actionList(){
       // print_r("abc1");die;
        return $this->dataProvider(ProfileSearch::getApiList(Yii::$app->request->post(), null, true));
    }
}
