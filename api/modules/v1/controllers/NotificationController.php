<?php

namespace app\modules\v1\controllers;

class NotificationController extends ApiController {
    
    public function actionList(){        
        return $this->dataProvider(\common\models\NotificationSearch::getNotifactionDataApi(\Yii::$app->request->post(), $this->loginId(), true));
    }
    
    public function actionRead(){
        
        $notification_id = \Yii::$app->request->post('Notification');
        $notification_id = (isset($notification_id['notification_id']))?$notification_id['notification_id']: $notification_id;
        if(!$this->loginId()) return $this->errorLoginRequierd();
        return $this->success(["notification_id" => \common\models\NotificationStatus::markRead($notification_id, $this->loginId())]);
    }
    
    public function actionUnReadCount(){
        return $this->success(["un_read_count" => 101]);
    }
    
}
