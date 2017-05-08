<?php
namespace common\models;

class UploadFile extends UploadForm
{
    /**
     * @var UploadedFile
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,pdf'],
        ];
    }
}