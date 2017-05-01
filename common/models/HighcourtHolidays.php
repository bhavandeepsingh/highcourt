<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "highcourt_holidays".
 *
 * @property integer $id
 * @property integer $highcourt_id
 * @property integer $holiday_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class HighcourtHolidays extends \yii\db\ActiveRecord
{
    
    public $holydays_ids;
    public $holidaydata;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'highcourt_holidays';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['highcourt_id'], 'required','message' => 'Please select highcourts before saving holiday.'],
            [['holiday_id'], 'required'],
            [['highcourt_id', 'holiday_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'highcourt_id' => 'Highcourts',
            'holiday_id' => 'Holiday ID',
            'status' => 'Status',
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
    
    public static function updateHolidays($params, $highcourt_id){
         //print_r($params);die;
        $model = new self();
        $model->load($params);
        $model->holiday_id = $highcourt_id; 
        
        if(is_array($model->highcourt_id)){
            $model->holydays_ids = $model->holiday_id;
            $model->holidayDelete($model->highcourt_id);
            foreach($model->highcourt_id as $id){
                $model->highcourt_id = $id;
                $model->setIsNewRecord(true);
                $model->id = null;
                //$model->holidayDelete();
                $model->checkExistsAndSave();
            }
        }
    }
    
    public function checkExistsAndSave(){
        if(!$this->find()->andWhere(['highcourt_id' => $this->highcourt_id, 'holiday_id' => $this->holiday_id])->one()){  
            $this->save();
        }
    }
    public function holidayDelete($id){
        $holidaydata = $this->find()->andWhere(['holiday_id' => $this->holiday_id])->all();
        $holidays = array();
        foreach($holidaydata as $holiday){
         
            array_push($holidays, $holiday->highcourt_id);
           
        }
        
        $result=array_diff($holidays,$id);
        if(!empty($result)){
           
           HighcourtHolidays::find()->andWhere(['holiday_id' => $this->holiday_id,'highcourt_id' => [implode(',',$result)]])->one()->delete(); 
        } 
        
    }
    
    public function getHighcourts(){
        return $this->hasOne(Highcourts::class, ['id' => 'highcourt_id']);
    }
    
}
