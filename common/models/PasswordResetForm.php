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
class PasswordResetForm extends \yii\base\Model
{
    
    private $_user;
    public $old_password;
    public $new_password;
            
    function __construct($_user) {
        $this->_user = $_user;
    }

    
    public function rules()
    {
        return [
            [['new_password', 'old_password'], 'required'],
            [['new_password', 'old_password'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'new_password' => 'New Password',
            'old_password' => 'Old Password',        
        ];
    }
    
    public function validate($attributeNames = null, $clearErrors = true) {
        if(!$this->_user->validatePassword($this->old_password)){
            $this->addErrors(['old_password' => 'Old password not match!']);
            return false;
        }
        return parent::validate($attributeNames, $clearErrors);
    }
    
    public function resetPassword(){
        return $this->_user->resetPassword($this->new_password);
    }
    
}
