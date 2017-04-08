<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Banner".
 *
 * @property integer $id
 * @property string $url
 * @property integer $index
 * @property integer $status
 */
class Banners extends \yii\db\ActiveRecord
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
            [['url', 'index', 'status'], 'required'],
            [['index', 'status'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'index' => 'Index',
            'status' => 'Status',
        ];
    }
}
