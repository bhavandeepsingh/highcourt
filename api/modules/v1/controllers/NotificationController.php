<?php

namespace app\modules\v1\controllers;

class NotificationController extends ApiController {
    
    public function actionList(){        
        return $this->dataProvider(\common\models\NotificationSearch::getNotifactionDataApi(\Yii::$app->request->post(), $this->loginId(), true));
    }
    
}
