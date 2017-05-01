<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "holidays".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property integer $status
 */
class Holidays extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'holidays';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'date', 'status'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['status'], 'integer'],
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
            'date' => 'Date',
            'status' => 'Status',
        ];
    }
    
    public function getHighcourtHoliday(){
        return $this->hasMany(HighcourtHolidays::class, ['holiday_id' => 'id']);
    }
    public function holidaysCourts($holidayIn){
        $holidayCourt ="";
        foreach($holidayIn as $h){
        $holidayCourt .= "  "; 
        $holidayCourt  .= $h->highcourts->name;
        }
        return $holidayCourt;
    }
}
