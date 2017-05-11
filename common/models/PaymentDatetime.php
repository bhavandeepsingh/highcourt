<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_datetime".
 *
 * @property int $id
 * @property int $payment_id
 * @property string $date
 */
class PaymentDatetime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_datetime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_id', 'date'], 'required'],
            [['payment_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'date' => 'Date',
        ];
    }
    
    public function getPayment()
    {
        return $this->hasOne(PaymentLog::class, ['id' => 'payment_id']);
    }
    
}
