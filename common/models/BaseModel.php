<?php
namespace common\models;

class BaseModel extends \yii\db\ActiveRecord{        
   
    public $login_id;


    public function getFormatedCreateAt(){
        return $this->getFormateddate($this->created_at);
    }
    
    public function getFormatedUpdateAt(){
        return $this->getFormateddate($this->updated_at);
    }
    
    public function getFormateddate($timestamp){
        return date('Y-m-d', $timestamp);
    }
    
    public static function getInstance(){
        $className = get_called_class();
         return new $className();         
    }
    
}
