<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Holidays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holidays-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => "Title"]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => "Description"]) ?>

    <?php 
    $holiday_model = new \common\models\HighcourtHolidays();
    if($model->id > 0){
        $holiday_model->highcourt_id = array_keys(\yii\helpers\ArrayHelper::map(\common\models\HighcourtHolidays::find($model->id)->andWhere(['holiday_id' => $model->id])->all(), 'highcourt_id', 'highcourt_id'));    
    }
     echo $form->field($holiday_model, 'highcourt_id')->checkboxList(yii\helpers\ArrayHelper::map(\common\models\Highcourts::find()->all(), 'id', 'name'));          
    ?>
    
    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        // inline too, not bad        
        // modify template for custom rendering
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([0 => "Inactive", 1 => "Active"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
