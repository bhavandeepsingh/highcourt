<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Judges */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="judges-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "Name"]) ?>
    
    <?= $form->field(new \common\models\UploadForm(), 'imageFile')->fileInput() ?> 
    <?php
    if($model->id > 0){
        ?>
            <img src="<?= \common\models\UploadForm::getJudgeProfilePic($model->id); ?>" width="100"/>
        <?php
    }
    ?>

    <?= $form->field($model, 'address')->textarea(['maxlength' => true, 'placeholder' => "Address", 'rows' => 5]) ?>

    <?= $form->field($model, 'dob')->widget(DatePicker::className(), [
        // inline too, not bad        
        // modify template for custom rendering
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>
    
    <?= $form->field($model, 'ext_no')->input('number', ['min' => 0, 'placeholder' => "Ext Number"]) ?>
    
    <?= $form->field($model, 'court_room')->input('number', ['min' => 0, 'placeholder' => "Court Room"]) ?>

    <?= $form->field($model, 'date_of_appointment')->widget(DatePicker::className(), [
        // inline too, not bad        
        // modify template for custom rendering
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ]); ?>    

    <?= $form->field($model, 'date_of_retirement')->widget(DatePicker::className(), [
        // inline too, not bad        
        // modify template for custom rendering
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'bio_graphy')->textarea(['rows' => 6, 'placeholder' => "Biography"]) ?>
            
    <?= $form->field($model, 'landline')->textInput(['type' => 'number']) ?>
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
