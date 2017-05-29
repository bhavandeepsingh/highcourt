<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "case_law_status".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $case_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class CaseLawStatus extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'case_law_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'case_id'], 'required'],
            [['user_id', 'case_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'case_id' => 'Case ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function markRead($case_ids, $user_id){         
        if(is_array($case_ids)){
            foreach($case_ids as $n) {           
                $model = new self();        
                $model->case_id = $n;
                $model->user_id = $user_id;               
                (!$model->checkExists() && !$model->save());                
            }
        }
        return true;
    }
    
    public function checkExists(){
        return $this->find()->andWhere(['user_id' => $this->user_id, 'case_id' => $this->case_id])->one();        
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];                
    }
    
    public static function getUnReadCountApi($params = [], $login_id = 0, $as_array = false){
        return self::getInstance()->unReadCoun($params, $login_id, $as_array);
    }
    
    public function unReadCoun($params = [], $login_id = 0, $as_array = false){
         $this->login_id = $login_id;
        $query = CaseLaw::find()->alias('n');
        $query->joinWith(['caseStatus'=> function($q){
            $q->onCondition(['user_id' => $this->login_id]);
        }], false, 'LEFT JOIN');
        return $query->where('user_id IS NULL')->count();
         
    }
}
