<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?= $form->field(new \common\models\UploadForm(), 'uploadFile')->fileInput() ?> 
    <div class="col-sm-9 col-sm-offset-3">
        <div class="form-group">
    <?php
        /*if($model->id > 0){
            ?>
                <img src="<?= $model->fileSrc; ?>" width="100"/>
            <?php
        }*/
    ?></div>
    </div>

    <?php //$form->field($model, 'sender_id')->textInput() ?>

    <?php //$form->field($model, 'reciever_id')->textInput() ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
