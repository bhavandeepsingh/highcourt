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
}
