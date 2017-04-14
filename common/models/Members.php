<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\UploadForm;
/**
 * This is the model class for table "{{%members}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $enrollment_no
 * @property string $membership_no
 * @property string $email_id
 * @property string $landline_no
 * @property string $mobile_no
 * @property string $residential_address
 * @property string $court_address
 * @property integer $blood_group
 * @property integer $created_at
 * @property integer $updated_at
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%members}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'enrollment_no', 'membership_no', 'email_id', 'landline_no', 'residential_address', 'court_address', 'blood_group', 'mobile_no'], 'required'],
            [['landline_no', 'residential_address', 'court_address'], 'required'],            
            [['blood_group', 'created_at', 'updated_at'], 'integer'],
            [['name', 'enrollment_no', 'membership_no', 'email_id'], 'string', 'max' => 255],
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
            'enrollment_no' => 'Enrollment No',
            'membership_no' => 'Membership No',
            'email_id' => 'Email ID',
            'landline_no' => 'Landline No',
            'mobile_no' => 'Mobile No',
            'residential_address' => 'Residential Address',
            'court_address' => 'Court Address',
            'blood_group' => 'Blood Group',
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
    
    public function beforeSave($insert) {
        $this->mobile_no = json_encode(array_filter($this->mobile_no));        
        return parent::beforeSave($insert);
    }
    
    public function getBloodGroup(){
        return $this->hasOne(BloodGroups::className(), ['id' => 'blood_group']);
    }
    
}
