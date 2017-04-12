<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "membership_types".
 *
 * @property integer $id
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
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'amount'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'amount' => 'Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
