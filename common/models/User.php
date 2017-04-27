<?php
namespace common\models;

use dektrium\user\models\User as BaseUser;
use Yii;

class User extends BaseUser
{   
    public $mobile = "";
    
    public function rules() {
        $rules = parent::rules();
        $rules[] = [["mobile"],"integer"];
        return $rules;
    }
    
    public function afterValidate() {
        $var = parent::afterValidate();
        if($this->hasErrors("email") && empty($this->mobile)){
            $this->clearErrors("email");
            $this->addError("mobile","You need to fill either Mobile or Email");
            $this->addError("email","You need to fill either Mobile or Email");
        }else if(!empty($this->mobile)){
            $this->clearErrors("email");
        }
        $mobile = \common\models\Profile::find()->where(["mobile" => $this->mobile])->one();
        if(@$mobile->mobile){
            $this->addError("mobile","Mobile number already in use.");
        }
        return $var;
    }
    
    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            $this->password = $this->password == null ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_CREATE);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }
            
            $this->confirm();
            
            if(empty($this->email)){
                \common\helpers\SmsHelper::send($this->mobile, 'Your CHDBAR association account has been created, Your Username is '.$this->username.' and Password is '.$this->password);
            }
            if(!empty($this->email)){
                $this->mailer->sendWelcomeMessage($this, null, true);
            }
            $this->trigger(self::AFTER_CREATE);
            
            $this->profile->mobile=$this->mobile;
            $this->profile->save();
            
            $transaction->commit();
            
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    
    public function resetPassword($password){        
        return $this->sendNewPasswordToUser(Yii::$app->security->generateRandomString(8));
    }
    
    
    public function sendNewPasswordToUser($password){
        if(parent::resetPassword($password)){            
            return $password;
        }
        return false;
    }

    public function getProfile(){
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }
    
}
