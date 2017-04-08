<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "judges_executives".
 *
 * @property integer $id
 * @property string $name
 * @property string $designation
 * @property string $description
 * @property integer $type
 * @property string $createdOn
 * @property integer $status
 */
class JudgesExecutives extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'judges_executives';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['type', 'status'], 'integer'],
            [['createdOn'], 'safe'],
            [['name', 'designation'], 'string', 'max' => 255],
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
            'designation' => 'Designation',
            'description' => 'Description',
            'type' => 'Type',
            'createdOn' => 'Created On',
            'status' => 'Status',
        ];
    }
}
