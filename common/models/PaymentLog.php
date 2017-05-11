<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "payment_log".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $payment_type
 * @property string $payment_token
 * @property integer $status
 * @property string $response
 * @property integer $created_at
 * @property integer $updated_at
 */
class PaymentLog extends \yii\db\ActiveRecord
{
    public static $INIT  =   0;
    public static $SUCCESS  =   1;
    public static $ABORT    =   2;
    public static $FAILURE  =   3;
    public static $ILLEGAL  =   4;
    public static $ERROR    =   5;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_type', 'status'], 'integer'],
            [['response'], 'string'],
            [['subscription_id'], 'safe'],
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
            'payment_type' => 'Payment Type',
            'subscription_id' => 'Subscription Id',
            'status' => 'Status',
            'response' => 'Response',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getLog()
    {
        return $this->hasMany(PaymentDatetime::class, ['payment_id' => 'id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(\common\models\Profile::class, ['user_id' => 'user_id']);
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
