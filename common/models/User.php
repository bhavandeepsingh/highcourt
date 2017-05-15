<?php
namespace common\models;

use dektrium\user\models\User as BaseUser;
use dektrium\user\helpers\Password as Password;
use Yii;

class User extends BaseUser
{   
    public $mobile = "";

    public static $usernameRegexp = '/^[-a-zA-Z0-9_\.@\/]+$/';
    
    public function rules() {
        $rules = parent::rules();
        $rules[] = [["mobile"], "integer", "max" => 9999999999, "message" => "Please enter a valid mobile number"];
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
        $isPost=\Yii::$app->request->isPost;
        $userid= Yii::$app->request->get("id",0);
        if(isset($isPost) && $userid)
            $mobile = \common\models\Profile::find()->where(["mobile" => $this->mobile])->andWhere(['!=', 'user_id', $userid])->one();
        else   
            $mobile = \common\models\Profile::find()->where(["mobile" => $this->mobile])->one();
        
        if(@$mobile->mobile){
            $this->addError("mobile","Mobile number already in use.");
        }
        return $var;
    }

    public function insert_import_data($data){

           if ($this->getIsNewRecord() == false) 
           {
             throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
            }



        $transaction = $this->getDb()->beginTransaction();

        try {
            //Password::generate(8)
            $pass = mt_rand(10000, 99999);
            $this->password = $this->password == null ? $pass : $this->password;

            

            $this->trigger(self::BEFORE_CREATE);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }
            
            $this->confirm();

            if(!empty($this->mobile))
            {
                //\common\helpers\SmsHelper::send($this->mobile, $this->message($this->username,$this->password));
            }

            $settings = \common\models\Settings::find()->where(["name" => "settings"])->one();
            $settings = json_decode(@$settings->value);

            echo $settings->admin_email;

            //die;
            
            if(@$settings->admin_email)
            {
                Yii::$app->params["adminEmail"] = $settings->admin_email;
                // setting admin email form database
            }

           
            
            $this->mailer->sendWelcomeMessage($this, null, true);

            $this->trigger(self::AFTER_CREATE);
            
            $this->profile->mobile=$this->mobile;
            $this->profile->public_email=$this->email;
            $this->profile->enrollment_number=$this->username;

            /*  @abr  */

            $this->profile->name=$data['name'];
            $this->profile->residential_address=$data['address'];
           
            /*  @abr  */
            

            $this->profile->save();
            
            $transaction->commit();
            
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    

    }
    
    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            //Password::generate(8)
            $pass = mt_rand(10000, 99999);
            $this->password = $this->password == null ? $pass : $this->password;

            $this->trigger(self::BEFORE_CREATE);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }
            
            $this->confirm();

            if(!empty($this->mobile)){
                \common\helpers\SmsHelper::send($this->mobile, $this->message($this->username,$this->password));
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
            $this->profile->public_email=$this->email;
            $this->profile->enrollment_number=$this->username;
            $this->profile->save();
            
            $transaction->commit();
            
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $this->profile->mobile=$this->mobile;
        $this->profile->public_email=$this->email;
        $this->profile->enrollment_number=$this->username;
        $this->profile->save();
    }
    
    public function resendPassword()
    {
        $this->password = Password::generate(8);
        $this->save(false, ['password_hash']);
        if(@$this->profile->mobile){
            \common\helpers\SmsHelper::send(@$this->profile->mobile, $this->message($this->username,$this->password));
        }
        $this->mailer->sendGeneratedPassword($this, $this->password);
        return true;
    }
    
    public function message($username,$password){
        return 'Your account for bas association has been created, Username: '.$username.', Password:'.$password.' Apps Android https://goo.gl/L1jNZX And IOS https://goo.gl/GrKfnO';
    }
    
    public function resetPasswordMessage($username,$password){
        return 'Your CHDBAR Association account Password has been changed to '.$password;
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
        if(@$this->profile->mobile){
            \common\helpers\SmsHelper::send(@$this->profile->mobile, $this->resetPasswordMessage($this->username,$password));
        }
        return $this->sendNewPasswordToUser($password);
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
    
    public static function findByUsername($username) {
        $user = self::find()
            ->where([
                "username" => $username
            ])
            ->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }
    
}
