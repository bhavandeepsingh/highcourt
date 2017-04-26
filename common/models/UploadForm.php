<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    public static $IMAGE_TYPE_JUDGES = "IMAGE_TYPE_JUDGES";
    
    public static $IMAGE_TYPE_MEMBERS = "IMAGE_TYPE_MEMBERS";
    
    public static $IMAGE_TYPE_USERS = "IMAGE_TYPE_USERS";
    
    public static $IMAGE_TYPE_BANNERS = "IMAGE_TYPE_BANNERS";
    
    public static $FILE_TYPE_NOTIFICATIONS = "FILE_TYPE_NOTIFICATIONS";
    
    /**
     * @var UploadedFile
     */
    public $imageFile;
    
    public $uploadFile;

    public $currentType = [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg'];
    
    public function rules()
    {
        return [
            $this->currentType,
        ];
    }
    
    public function upload($path, $name = "", $type=null)
    {        
        if ($this->validate()) {            
            if (!is_dir($path)) {                
                mkdir($path, 0777, true);
            }
            if(isset($this->imageFile)){
                $this->imageFile->saveAs($path . '/' . ( (!empty($name))? $name: $this->imageFile->baseName) . '.' . $this->imageFile->extension);
            }
            if(isset($this->uploadFile)){
                $this->currentType = [['uploadFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,xls,doc,pdf'];
                $this->uploadFile->saveAs($path . '/' . ( (!empty($name))? $name: $this->uploadFile->baseName) . '.' . $this->uploadFile->extension);
            }              
            return true;
        } else {
            return false;
        }
    }
    
    public static function typePath($type){
        $type_path = "";
        if($type == self::$IMAGE_TYPE_JUDGES){
            $type_path = "judges/";
        }else if($type == self::$IMAGE_TYPE_MEMBERS){
            $type_path = "members/";
        }else if($type == self::$IMAGE_TYPE_USERS){
            $type_path = "users/";
        }else if($type == self::$IMAGE_TYPE_BANNERS){
            $type_path = "banners/";
        }else if($type == self::$FILE_TYPE_NOTIFICATIONS){
            $type_path = "notifications/";
        }
        return $type_path;
    }
    
    public static function getPicSrcByType($id,$type){
        switch ($type) {
            case self::$IMAGE_TYPE_JUDGES:
                return self::getJudgeProfilePic($id);
                break;
            case self::$IMAGE_TYPE_MEMBERS:
                return self::getMemberProfilePic($id);
                break;
            case self::$IMAGE_TYPE_USERS:
                return self::getUserProfilePic($id);
                break;
            case self::$IMAGE_TYPE_BANNERS:
                return self::getBannerProfilePic($id);
                break;
            case self::$FILE_TYPE_NOTIFICATIONS:
                //return self::getFileSrc($type, $id)
                break;
            default:
                break;
        }
    }
    
    public function getPathWithType($type){
        $type_path = self::typePath($type);
        return Yii::$app->basePath . '/../uploads/'. $type_path;
    }
    
    public static function uploadProfilePic($id, $type){          
        $model = self::getImageInstance();         
        if(!empty($model->imageFile)){          
            if($model->upload($model->getPathWithType($type). $id, "image")){                 
                return true;
            }
        }        
        return false;
    }
    
    public static function uploadFile($id, $type){          
        $model = self::getFileInstance();          
        if(!empty($model->uploadFile)){
            if($model->upload($model->getPathWithType($type). $id, "file")){                 
                return true;
            }
        }        
        return false;
    }
    
    public static function getImageInstance(){
        $model = new self;
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        return $model;
    }
    
    public static function getFileInstance(){
        $model = new self;
        $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
        return $model;
    }
    
    public static function uploadUserProfilePic($id){
        return self::uploadProfilePic($id, self::$IMAGE_TYPE_USERS);
    }
    
    public static function uploadJudgeProfilePic($id){
        return self::uploadProfilePic($id, self::$IMAGE_TYPE_JUDGES);
    }
    
    public static function uploadMemberProfilePic($id){
        return self::uploadProfilePic($id, self::$IMAGE_TYPE_MEMBERS);
    }
    
    public static function uploadBannerProfilePic($id){
        return self::uploadProfilePic($id, self::$IMAGE_TYPE_BANNERS);
    }
    
    public static function uploadNotificationFile($id){
        return self::uploadFile($id, self::$FILE_TYPE_NOTIFICATIONS);
    }
    
    public static function getJudgeProfilePic($id = 0){
        if($id <= 0) return "";
        $root = self::getImageSrc(self::$IMAGE_TYPE_JUDGES, $id);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$root)){
            return $root;
        }
        return false;
    }
    
    public static function getUserProfilePic($id = 0){
        if($id <= 0) return "";
        $root = self::getImageSrc(self::$IMAGE_TYPE_USERS, $id);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$root)){
            return $root;
        }
        return false;
    }
    
    public static function getMemberProfilePic($id = 0){
        if($id <= 0) return "";
        $root = self::getImageSrc(self::$IMAGE_TYPE_MEMBERS, $id);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$root)){
            return $root;
        }
        return false;
    }
    
    public static function getBannerProfilePic($id = 0){
        if($id <= 0) return "";
        $root = self::getImageSrc(self::$IMAGE_TYPE_BANNERS, $id);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$root)){
            return $root;
        }
        return false;
    }
    
    public static function getNotificationFile($id = 0){
        if($id <= 0) return "";
        $root = self::getFileSrc(self::$FILE_TYPE_NOTIFICATIONS, $id);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$root)){
            return $root;
        }
        return false;
    }
    


    public static function getImageSrc($type, $id){
        $type_path = self::typePath($type);
        $type_path .= $id. "/image.jpg";

        return Yii::$app->urlManager->baseUrl.'/../../uploads/'.$type_path;
    }
    
    public static function getFileSrc($type, $id){        
        $type_path = self::getTypePath($type). $id. "/file.jpg";
        return Yii::$app->urlManager->baseUrl.'/../../uploads/'.$type_path;
    }
    
    public static function getTypePath($type){
        $type_path = self::typePath($type);
        return $type_path;
    }
    
    public static function getJudgeTypePathApi(){
        return \yii\helpers\Url::base(true).'/../../uploads/'.self::getTypePath(self::$IMAGE_TYPE_JUDGES);
    }
    
    /*
     * deleteImage function takes two parameters $id and $type
     * This will them remove the images as well as folder from location
     */
    
    public static function deleteImage($id,$type){
        $root = $_SERVER["DOCUMENT_ROOT"];
        $src='';
        $src = self::getPicSrcByType($id, $type);
        if($src!=''){
            $imagesrc = $root.$src;
            $dirname = str_replace('image.jpg', '',$imagesrc);
            unlink($imagesrc);
            rmdir($dirname);
        }    
    }
    
    
}
