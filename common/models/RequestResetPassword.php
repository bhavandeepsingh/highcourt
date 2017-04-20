<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%judges}}".
 *
 * @property string $new_password
 * @property string $old_password
 * 
 */
class RequestResetPassword extends \yii\base\Model
{
    
    private $_user;
    public $license_no;                    

    
    public function rules()
    {
        return [
            [['license_no'], 'required'],
            [['license_no'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'license' => 'License No',            
        ];
    }
    
    public function validate($attributeNames = null, $clearErrors = true) { 
        $parent_validate = parent::validate($attributeNames, $clearErrors);
        if($parent_validate && !$this->validateUser()) {            
            $this->addErrors(['license_no' => 'No user found with license no '. $this->license_no]);
            return false;
        }                
        return $parent_validate;
    }
    
    public function validateUser(){
        return $this->_user = @Profile::findByEnrollmentNumberNo($this->license_no)->user;        
    }
    
    public function requestSend(){
        return $this->_user->resetPassword();
    }
    
}
