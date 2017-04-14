<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    public static $IMAGE_TYPE_JUDGES = "IMAGE_TYPE_JUDGES";
    
    public static $IMAGE_TYPE_MEMBERS = "IMAGE_TYPE_MEMBERS";
    
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg'],
        ];
    }
    
    public function upload($path, $name = "")
    {        
        if ($this->validate()) {            
            if (!is_dir($path)) {                
                mkdir($path, 0777, true);
            }
            $this->imageFile->saveAs($path . '/' . ( (!empty($name))? $name: $this->imageFile->baseName) . '.' . $this->imageFile->extension);              
            return true;
        } else {
            return false;
        }
    }
    
    public function getPathWithType($type){
        $type_path = "";
        if($type == self::$IMAGE_TYPE_JUDGES){
            $type_path = "judges/";
        }
        else if($type == self::$IMAGE_TYPE_MEMBERS){
            $type_path = "members/";
        }
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
    
    public static function getImageInstance(){
        $model = new self;
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        return $model;
    }
    
    public static function getJudgeProfilePic($id = 0){
        if($id <= 0) return "";
        return self::getImageSrc(self::$IMAGE_TYPE_JUDGES, $id);
    }
    
    public static function getMemberProfilePic($id = 0){
        if($id <= 0) return "";
        return self::getImageSrc(self::$IMAGE_TYPE_MEMBERS, $id);
    }
    
    public static function getImageSrc($type, $id){
        $type_path = "";
        if($type == self::$IMAGE_TYPE_JUDGES){
            $type_path = "judges/";
        }else if($type == self::$IMAGE_TYPE_MEMBERS){
            $type_path = "members/";
        }        
        $type_path .= $id. "/image.jpg";
        return Yii::$app->urlManager->baseUrl.'/../../uploads/'.$type_path;
    }
    
}