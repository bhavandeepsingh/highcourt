<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%benches}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 */
class Benches extends \yii\db\ActiveRecord
{
    
    public static $BENCH_TYPE_SINGLE = 1;
    public static $BENCH_TYPE_DEVISION = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%benches}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name'], 'string'],
            [['type', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Category Name',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    public function getBenchTypes(){
        return [
            self::$BENCH_TYPE_SINGLE => 'Single' ,
            self::$BENCH_TYPE_DEVISION => 'Devision'
        ];
    }
}
