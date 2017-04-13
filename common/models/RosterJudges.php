<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%roster_judges}}".
 *
 * @property integer $id
 * @property integer $roster_id
 * @property integer $judge_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class RosterJudges extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%roster_judges}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roster_id', 'judge_id'], 'required'],
            [['roster_id', 'judge_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roster_id' => 'Roster ID',
            'judge_id' => 'Judge ID',
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
    
    public function save($runValidation = true, $attributeNames = null) {
        if(!$this->checkExisting()){
            parent::save($runValidation, $attributeNames);
        }
    }
    
    public function checkExisting(){
        return self::find()->where(['judge_id' => $this->judge_id , 'roster_id' => $this->roster_id])->one();
    }
    
    public static function updateRosterJudge($roster_id, $request){
        $modelJudges = new self();
        $modelJudges->load($request);
        $modelJudges->checkForDelete($roster_id);
        if(is_array($modelJudges->judge_id) AND count($modelJudges->judge_id) > 0){
            foreach($modelJudges->judge_id as $j){
                $model = new self();
                $model->roster_id = $roster_id;
                $model->judge_id = $j;                        
                $model->save();
            }
        }        
    }
    
    public function checkForDelete($roster_id){
        $exists = self::find()->where(['roster_id' => $roster_id])->all();
        if(count($exists) > 0){
            foreach($exists as $e){
                if(!in_array($e->judge_id, $this->judge_id)){
                    $e->delete();
                }
            }
        }
    }
    
    public function getJudge(){
        return $this->hasOne(Judges::className(), ['id' => 'judge_id']);
    }
}
