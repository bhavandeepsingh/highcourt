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
    
    <?= $form->field(new \common\models\UploadForm(), 'imageFile')->fileInput(["onChange" => "readURL(this);"]) ?> 
    
    <?php
        if($model->id > 0 && ($model->JudgePicSrc)){
            ?>
                <img src="<?= $model->JudgePicSrc; ?>" width="100"/>
            <?php
        }
    ?>

    <?= $form->field($model, 'address')->textarea(['maxlength' => true, 'placeholder' => "Address", 'rows' => 5]) ?>

    <?= $form->field($model, 'dob')->textInput(["placeholder" => "Date Of Birth"]) ?>
    
    <?= $form->field($model, 'ext_no')->input('number', ['min' => 0, 'placeholder' => "Ext Number"]) ?>
    
    <?= $form->field($model, 'court_room')->input('number', ['min' => 0, 'placeholder' => "Court Room"]) ?>

    <?= $form->field($model, 'date_of_appointment')->textInput(["placeholder" => "Date of Appointment"]); ?>    

    <?= $form->field($model, 'bio_graphy')->textarea(['rows' => 5, 'placeholder' => "Biography"]) ?>

    <?= $form->field($model, 'date_of_retirement')->textInput(["placeholder" => "Date of Retirement"]); ?>
        
    <?= $form->field($model, 'landline')->textInput(['type' => 'number']) ?>
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css");
    $this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
    echo $this->registerJs('
        $("#judges-dob").datepicker({format : "yyyy-mm-dd",endDate:"0d"});
        $("#judges-date_of_appointment").datepicker({format : "yyyy-mm-dd",endDate:"0d"}).on("changeDate", function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $("#judges-date_of_retirement").datepicker("setStartDate", minDate);
        });
        $("#judges-date_of_retirement").datepicker({format : "yyyy-mm-dd",setStartDate:$("#judges-date_of_appointment").val()});
    ');
?>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("form img")
                    .attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>