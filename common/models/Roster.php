<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%roster}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $bench_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Roster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        
    
    public static function tableName()
    {
        return '{{%roster}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'bench_id'], 'required'],
            [['title', 'description'], 'string'],
            [['bench_id', 'created_at', 'updated_at'], 'integer'],
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
            'bench_id' => 'Bench ID',
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
    
    public function getJudges(){
        return $this->hasMany(RosterJudges::className(), ['roster_id' => 'id']);
    }
    
    public function getBench(){
        return $this->hasOne(Benches::className(), ['id' => 'bench_id']);
    }
    
    public function getSelectedJudges(){
        $selectedOption = [];
        if(count($this->judges) > 0){
            foreach ($this->judges as $j){
                $selectedOption[$j->judge_id] = ['selected'=>'selected'];                        
            }
        }return $selectedOption;
    }
    
    public function getJudgesString(){
        $str = "";
        if(count($this->judges) > 0){
            foreach($this->judges as $j){
                $str .= (!empty($str)? ", ": "") .@$j->judge->name;
            }
        }return $str;
    }
}
