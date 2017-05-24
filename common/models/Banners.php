<?php

namespace common\models;


/**
 * This is the model class for table "Banner".
 *
 * @property integer $id
 * @property string $url
 * @property integer $index
 * @property integer $status
 */
class Banners extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['index', 'status'], 'required'],
            [['index', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'index' => 'Index',
            'status' => 'Status',
        ];
    }
    
    public function afterSave($insert, $changedAttributes) {
        UploadForm::uploadBannerProfilePic($this->id);
        parent::afterSave($insert, $changedAttributes);
    }
    
    public function getBannerPicSrc(){             
        return UploadForm::getBannerProfilePic($this->id);
    }        
    
    public static function getApiDataProvider(){
        return  new \yii\data\ActiveDataProvider([
                'query' => self::getInstance()->getDataQuery(true),
                'pagination' => [
                    'pageSize' => 25
                ]
            ]);
    }
    
    public static function getBannerDataApi(){
        return self::getInstance()->getDataQuery(true)->all();
    }
    
    public function getDataQuery($asArray = false){
        $query = $this->find();
        $query->orderBy(['id' => SORT_DESC]);
        $query->addSelect(['*', 'getImageSrc("'.$this->getImageTypePathApi().'", id) as image_path']);
        $query->asArray($asArray);
        return $query;
    }    
    
    public function getImageTypePathApi(){
        return UploadForm::getBannerPathApi();
    }
    
}
