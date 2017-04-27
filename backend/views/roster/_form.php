<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Roster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roster-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'title')->textInput(['placeholder' => "Title"]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => "Description"]) ?>

    <?= $form->field($model, 'bench_id')->dropDownList(yii\helpers\ArrayHelper::map(\common\models\Benches::find()->all(), 'id', 'name'), ['prompt' => 'Select Bench']) ?>
    
    <?= $form->field($model, 'type')->dropDownList([1 => "Single", 2 => "Division"], ['prompt' => 'Select Bench Type'])?>
    
    <?= $form->field($modelJudges, 'judge_id[]')->dropDownList(yii\helpers\ArrayHelper::map(\common\models\Judges::find()->all(), 'id', 'name'), ['prompt' => 'Select Judges', 'multiple' => 'multiple', 'class'=>'chosen-select required', 'style' => 'width:100%;', 'options' => $model->getSelectedJudges()])?>
  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJs('
        $("#roster-type").on("change",function(){
            if($(this).val()==1){
                $("#rosterjudges-judge_id").removeAttr("multiple");
            }else{
                $("#rosterjudges-judge_id").attr({"multiple":true});
            }
        });
    ');
?>