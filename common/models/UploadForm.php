<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    public static $IMAGE_TYPE_JUDGES = "IMAGE_TYPE_JUDGES";
    
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg'],
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
        return Yii::$app->basePath . '/../uploads/'. $type_path;
    }
    
    public static function judgeProfilePic($id){          
        $model = self::getImageInstance();         
        if(!empty($model->imageFile)){          
            if($model->upload($model->getPathWithType(self::$IMAGE_TYPE_JUDGES). $id, "image")){                 
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
    
    public static function getImageSrc($type, $id){
        $type_path = "";
        if($type == self::$IMAGE_TYPE_JUDGES){
            $type_path = "judges/".$id. "/image.jpg";
        }        
        return Yii::$app->urlManager->baseUrl.'/../../uploads/'.$type_path;
    }
    
}