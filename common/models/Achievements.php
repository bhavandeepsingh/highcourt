<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%achievements}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $destination
 * @property integer $achievement_year
 * @property integer $created_at
 * @property integer $updated_at
 */
class Achievements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%achievements}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'achievement_year'], 'required'],
            [['title', 'description', 'destination'], 'string'],
            [['achievement_year'] ,'unique', 'targetAttribute' => 'achievement_year'],
            [['achievement_year', 'created_at', 'updated_at'], 'integer'],
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
            'achievement_year' => 'Achievement Year',
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
    
    public function getAchievementYear(){
        return ($this->achievement_year - 1) ."/" .$this->achievement_year;
    }
    
    public function getImage(){
        return UploadForm::getAchevementPathApi($this->id);
    }
    
    public function getImageTag($config = []){
        $config['src'] = UploadForm::getAchevementPathApi($this->id)."?".time();
        return \yii\helpers\Html::tag('img', '', $config);
    }
    
    
}
