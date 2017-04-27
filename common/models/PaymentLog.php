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
            [['order_id', 'payment_type', 'status'], 'integer'],
            [['response'], 'string'],
            [['payment_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'payment_type' => 'Payment Type',
            'payment_token' => 'Payment Token',
            'status' => 'Status',
            'response' => 'Response',
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
