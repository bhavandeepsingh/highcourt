<?php
namespace common\models;

use dektrium\user\models\Profile as BaseProfile;

class Profile extends BaseProfile
{

    public $profile_pic;

    public function rules()
    {
        return [
            'bioString'            => ['bio', 'string'],
            'timeZoneValidation'   => ['timezone', 'validateTimeZone'],
            'publicEmailPattern'   => ['public_email', 'email'],
            'gravatarEmailPattern' => ['gravatar_email', 'email'],
            /*'websiteUrl'           => ['website', 'url'],*/
            'nameLength'           => ['name', 'string', 'max' => 255],
            'publicEmailLength'    => ['public_email', 'string', 'max' => 255],
            'publicEmailUnique'    => ['public_email', 'unique'],
            /*'gravatarEmailLength'  => ['gravatar_email', 'string', 'max' => 255],*/
            'locationLength'       => ['location', 'string', 'max' => 255],
            'websiteLength'        => ['website', 'string', 'max' => 255],
            'designation'          => ['designation', 'integer'],
            'profile'              => ['profile', 'string'],
            'enrollment_number'    => ['enrollment_number','string'],
            'membership_number'    => ['membership_number', 'string'],
            'landline'             => ['landline', 'string'],
            'mobile'               => ['mobile', 'string'],
            'residential_address'  => ['residential_address', 'string'],
            'court_address'        => ['court_address', 'string'],
            'blood_group'          => ['blood_group', 'string'],
            'lat1'                 => ['lat1', 'double'],
            'long1'                => ['long1', 'double'],
            'lat2'                 => ['lat2', 'double'],
            'long2'                => ['long2', 'double'],
            'executive'            => ['executive', 'integer'],
            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'name'                  => \Yii::t('user', 'Name'),
            'public_email'          => \Yii::t('user', 'Email (public)'),
            /*'gravatar_email' => \Yii::t('user', 'Gravatar email'),
            'website'        => \Yii::t('user', 'Website'),*/
            'location'              => \Yii::t('user', 'Location'),
            'weight'                => \Yii::t('user', 'Sort Position'),
            'bio'                   => \Yii::t('user', 'About'),
            'timezone'              => \Yii::t('user', 'Time zone'),
            'designation'           => \Yii::t('user', 'Designation'),
            'profile'               => \Yii::t('user', 'Profile'),
            'enrollment_number'     => \Yii::t('user', 'Enrollment No.'),
            'membership_number'     => \Yii::t('user', 'Membership No.'),
            'landline'              => \Yii::t('user', 'Landline'),
            'mobile'                => \Yii::t('user', 'Mobile'),
            'residential_address'   => \Yii::t('user', 'Residential Address Full'),
            'court_address'         => \Yii::t('user', 'Court Address Full'),
            'blood_group'           => \Yii::t('user', 'Blood Group'),
            'lat1'                  => \Yii::t('user', 'Latitude Home'),
            'long1'                 => \Yii::t('user', 'Longitude Home'),
            'lat2'                  => \Yii::t('user', 'Latitude Office'),
            'long2'                 => \Yii::t('user', 'Longitude Office'),
            'executive'             => \Yii::t('user', 'Executive'),
        ];
    }
    
    public function afterSave($insert, $changedAttributes) {
        //UploadForm::deleteImage($this->user_id, UploadForm::$IMAGE_TYPE_USERS);
        UploadForm::uploadUserProfilePic($this->user_id);
        if(isset($_POST["clerks"])){
            $data=$_POST["clerks"];
            Clerks::saveClerk($this->user_id, $data);
        }
        parent::afterSave($insert, $changedAttributes);
    }
    
    public function getProfilePicSrc(){
        return UploadForm::getUserProfilePic($this->user_id);
    }
    public function getProfilePicPathApi(){
        return UploadForm::getProfilePicPathApi($this->user_id);
    }
    
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public static function findByEnrollmentNumberNo($enrollment_number){
        return self::find()->where(['enrollment_number' => $enrollment_number])->one();
    }

    public function getProfileDataApi(){
        $profile =  @$this->getAttributes();       
        if($profile === null) return null;
        $profile['profilePic'] = @$this->getProfilePicPathApi();
        $designation = @$this->getDesignation()->one();
        if($designation != null ){
            $profile['designation'] = $designation->getAttributes();
        }else{
            $profile['designation'] = null;
        }
        
        $bloodGroup = @$this->getBloodGroup()->one();

        if($bloodGroup != null){
          $profile['bloodGroup'] = $bloodGroup;
        }else{ $profile['bloodGroup'] = null;}

        return $profile;
    }
    
    public function getDesignation(){
        return $this->hasOne(MembershipTypes::class, ['id' => 'designation']);
    }

    public function getBloodGroup(){
        return $this->hasOne(BloodGroups::className(), ['id' => 'blood_group']);
    }    
}
