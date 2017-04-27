<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $enrollment_number;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            [['enrollment_number', 'username'], 'string'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = null;
            if(!empty($this->enrollment_number)) $user = $this->getLaywerUser();
            else if(!empty($this->username)) $user = $this->getUser();               

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect license or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
    
    /**
     * Login with enrollment_number no
     * @return boolean
     */
    public function laywerLogin()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getLaywerUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);            
        } else {            
            return false;
        }
    }
    protected function getLaywerUser(){       
        if($this->_user === null){
            $this->_user = @Profile::findByEnrollmentNumberNo($this->enrollment_number)->user;
        }        
        return $this->_user;    
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
    
    public function getLoginUser(){
        return @$this->_user;
    }
    
    public function getProfile(){
        return @$this->_user->profile;                
    }

    public function getProfileArray(){
        return @$this->getProfile()->getProfileDataApi();
    }
    
}
