<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\UploadForm;

/**
 * This is the model class for table "{{%judges}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $dob
 * @property string $ext_no
 * @property integer $court_room
 * @property string $date_of_appointment
 * @property string $date_of_retirement
 * @property string $bio_graphy
 * @property integer $created_at
 * @property integer $updated_at
 */
class Judges extends \yii\db\ActiveRecord
{        
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%judges}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','gender', 'address', 'dob', 'ext_no', 'date_of_appointment', 'court_room', 'bio_graphy'], 'required'],
            [['dob','gender', 'date_of_appointment', 'date_of_retirement'], 'safe'],
            [['bio_graphy', 'landline'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'gender' => 'Gender',
            'address' => 'Address',
            'dob' => 'Dob',
            'date_of_appointment' => 'Date Of Appointment',
            'date_of_retirement' => 'Date Of Retirement',
            'bio_graphy' => 'Bio Graphy',
            'landline' => 'Landline',
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
    
    public function getImageTypePathApi(){
        return UploadForm::getJudgeTypePathApi();
    }
    
    public function getJudgePicSrc(){             
        return UploadForm::getJudgeProfilePic($this->id);
    }
    public function getSubtitleText(){
        return $this->getSubtitle($this->gender);
    }
    public function getSubtitle($index = NULL){
        $array = [
            1 => "Mr.",
            2 => "Miss",
            3 => "Mrs",
            4 => "Ms",
        ];
        if($index!=NULL){
            return $array[$index];
        }
        return $array;
    }
    
    public function getNameWithSubtitle(){
        return "Hon'ble ".$this->getSubtitleText()." ".$this->name;
    }
}
