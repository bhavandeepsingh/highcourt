<?php
namespace common\models;

class BaseModel extends \yii\db\ActiveRecord{        
   
    
    public function getFormatedCreateAt(){
        return $this->getFormateddate($this->created_at);
    }
    
    public function getFormatedUpdateAt(){
        return $this->getFormateddate($this->updated_at);
    }
    
    public function getFormateddate($timestamp){
        return date('m/d/Y', $timestamp);
    }
    
}
