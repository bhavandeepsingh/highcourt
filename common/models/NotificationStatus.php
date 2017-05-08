<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification_status".
 *
 * @property integer $id
 * @property integer $notification_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class NotificationStatus extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_id', 'user_id'], 'required'],
            [['notification_id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notification_id' => 'Notification ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function markRead($notification_id, $user_id){         
        if(is_array($notification_id)){
            foreach($notification_id as $n) {           
                $model = new self();        
                $model->notification_id = $n;
                $model->user_id = $user_id;
                (!$model->checkExists() && !$model->save());
            }
        }
        return true;
    }
    
    public function checkExists(){
        return $this->find()->andWhere(['user_id' => $this->user_id, 'notification_id' => $this->notification_id])->one();        
    }
    
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }
}
