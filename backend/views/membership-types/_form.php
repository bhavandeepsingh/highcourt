<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MembershipTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membership-types-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php /*
    <div class="form-group">
        <label form="parents">Parents</label>
        <?php Html::dropDownList('parents', '', yii\helpers\ArrayHelper::map(common\models\MembershipTypes::find()->where(["parent_id"=>0])->all(), 'id', 'name'),['prompt' => 'Select Parent', 'class' => 'form-control','onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('membership-types/lists').'&id="+$(this).val(), function( data ) {
                    $( "select#membershiptypes-parent_id" ).html( data );
                });
            ']); ?>
    </div>
    <?php */
        $dataPost= yii\helpers\ArrayHelper::map(\common\models\MembershipTypes::find()->asArray()->all(), 'id', 'name');
        echo $form->field($model, 'parent_id')->dropDownList($dataPost, ['prompt' => 'Select a parent id']);
    ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, "placeholder" => "Name"]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, "placeholder" => "Amount (e.g : 200)"]) ?>

    <?= $form->field($model, 'status')->dropDownList([0 => 'Inactive', 1 => 'Active']) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
