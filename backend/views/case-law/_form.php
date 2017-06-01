<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CaseLaw */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="case-law-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput(["placeholder" => "Title"]) ?>

    <?= $form->field($model, 'discription')->textarea(['rows' => 6, "placeholder" => "Description"]) ?>
    
    <?= $form->field($model, 'url')->textInput(["placeholder" => "example url http://www.google.com"]); ?>
    
    <?php
        /*
        <?=  $form->field($model, 'created_at')->textInput() ?>
        <?= $form->field($model, 'updated_at')->textInput() */
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>