<?php
namespace common\models;

use dektrium\user\models\User as BaseUser;
use dektrium\user\helpers\Password as Password;
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
        //if($this->hasErrors("email") && empty($this->mobile)){
        if(empty($this->mobile)){
            //$this->clearErrors("email");
            $this->addError("mobile","Mobile number is required.");
            //$this->addError("email","You need to fill either Mobile or Email");
        }
        //else if(!empty($this->mobile)){
        //    $this->clearErrors("email");
        //}
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
            
            if(!empty($this->mobile)){
                \common\helpers\SmsHelper::send($this->mobile, $this->message($this->username, $this->password));
            }

            $settings = \common\models\Settings::find()->where(["name" => "settings"])->one();
            $settings = json_decode(@$settings->value);
            
            if(@$settings->admin_email){
                Yii::$app->params["adminEmail"] = $settings->admin_email;
                // setting admin email form database
            }
            
            $this->mailer->sendWelcomeMessage($this, null, true);
            
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
    
    public function message($username,$password){
        return 'Your CHDBAR association account has been created, Your Username is '.$username.' and Password is '.$password;
    }
    
    public function resendPassword()
    {
        $this->password = Password::generate(8);
        $this->save(false, ['password_hash']);
        
        if(!empty(@$this->profile->mobile)){
            \common\helpers\SmsHelper::send($this->profile->mobile, $this->message($this->username, $this->password));
        }
        
        return $this->mailer->sendGeneratedPassword($this, $this->password);
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
