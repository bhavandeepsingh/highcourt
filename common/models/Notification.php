<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $sender_id
 * @property integer $reciever_id
 * @property integer $is_file
 * @property integer $created_at
 * @property integer $updated_at
 */
class Notification extends BaseModel
{
    
    public static $_NOTIFICTION_HAS_FILE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['is_file'], 'integer'],
            //[['sender_id', 'reciever_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'sender_id' => 'Sender ID',
            'reciever_id' => 'Reciever ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getFileSrc(){
        $root = UploadForm::getNotificationFile($this->id);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$root)){
            return $root;
        }
        return false;
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    public function hasFile(){
        $this->is_file = self::$_NOTIFICTION_HAS_FILE;
        $this->save();
    }
}
