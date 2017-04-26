<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "clerks".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $phone
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Clerks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clerks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'phone'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function saveClerk($id,$data){
        self::deleteAll(["user_id"=>$id]);
        for($i=0;$i<count($data["name"]);$i++){
            $model = new self;
            $model->user_id = $id;
            $model->name = $data["name"][$i];
            $model->phone = $data["contact"][$i];
            $model->save();
        }
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
