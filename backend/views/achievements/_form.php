<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Achievements */
/* @var $form yii\widgets\ActiveForm */

$year_array ;
$current_year = date("Y", time());
for($i = 19; $i > 0; $i--){
    $year_array[$current_year] = ($current_year-1)."/".$current_year;
    $current_year--;
}
?>

<div class="achievements-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'id' => 'achevement_editor']) ?>

    <?= $form->field($model, 'destination')->textInput() ?>

    <?= $form->field($model, 'achievement_year')->dropDownList($year_array) ?>
    
    <?= $form->field(new \common\models\UploadForm(), 'imageFile')->fileInput() ?>
        
    <?php
        if($model->id > 0):
    ?>
        <div class="form-group field-achievements-description required has-success">
            <img src="<?= \common\models\UploadForm::getAchevementPic($model->id)?>" width="150"/>
        </div>
    <?php
        endif;
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->registerJs('tinymce.init({selector: \'#achevement_editor\'});') ?>
