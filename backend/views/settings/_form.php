<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-3"><b>Set Banner Scroll Time (In Sec)</b></div>
            <div class="col-sm-9"><?php echo Html::textInput('settings[scroll_time]', (isset($data["scroll_time"]))?$data["scroll_time"]:"", ['placeholder' => 'Set Banner Scroll Time', 'class' => 'form-control']) ?></div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-3"><b>Admin E-mail</b></div>
            <div class="col-sm-9"><?php echo Html::textInput('settings[admin_email]', (isset($data["admin_email"]))?$data["admin_email"]:"", ['placeholder' => 'Admin E-Mail', 'class' => 'form-control']) ?></div>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>