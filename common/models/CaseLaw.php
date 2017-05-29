<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "case_law".
 *
 * @property integer $id
 * @property string $discription
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class CaseLaw extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'case_law';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['discription', 'title'], 'required'],
            [['discription', 'title'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discription' => 'Discription',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];                
    }
    
    public function getCaseStatus(){
        return $this->hasOne(CaseLawStatus::className(), ['case_id' => 'id']);
    }
        
    
}
