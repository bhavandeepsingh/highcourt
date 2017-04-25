<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field(new \common\models\UploadForm(), 'imageFile')->fileInput() ?> 
    <div class="col-sm-9 col-sm-offset-3">
        <div class="form-group">
    <?php
        if($model->id > 0){
            ?>
                <img src="<?= $model->bannerPicSrc; ?>" width="100"/>
            <?php
        }
    ?></div>
    </div>
    
    <?php //$form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'index')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([0 => 'Inactive', 1 => 'Active']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
