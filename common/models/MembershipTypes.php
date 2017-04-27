<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "membership_types".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $amount
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class MembershipTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['amount'], 'match' ,
                'pattern'=> '/^[0-9\.]+$/u',
                'message'=> 'Please enter a valid amount. (eg. 100.00)'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'amount' => 'Amount',
            'status' => 'Status',
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
}
