<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "Name"]) ?>
    
    <?= $form->field(new \common\models\UploadForm(), 'imageFile')->fileInput() ?> 
    
    <?php
    if($model->id > 0){
    ?>
    <img src="<?= \common\models\UploadForm::getMemberProfilePic($model->id); ?>" width="100"/>
    <?php
    }
    ?>

    <?= $form->field($model, 'enrollment_no')->textInput(['maxlength' => true, 'placeholder' => "Enrollment Number"]) ?>

    <?= $form->field($model, 'membership_no')->textInput(['maxlength' => true, 'placeholder' => "Membership Number"]) ?>

    <?= $form->field($model, 'email_id')->textInput(['maxlength' => true, 'placeholder' => "Email Id"]) ?>

    <?= $form->field($model, 'landline_no')->textInput(['maxlength' => true, 'placeholder' => "Landline Number"]) ?>

    <div class="members_mobile_no clearfix">         
        <?php         
            if(!empty($model->mobile_no)){
                $json = (is_array($model->mobile_no))? $model->mobile_no: json_decode($model->mobile_no);
                if(count($json)){
                    foreach($json as $k => $j){
                        echo $this->render('mobile_no_filed', ['form' => $form, 'model' => $model, 'k' => $k, 'j' => $j]);
                    }
                }
            }else{
                echo $this->render('mobile_no_filed', ['form' => $form, 'model' => $model, 'k' => 0]);
            }
        ?>
    </div>

    <?= $form->field($model, 'residential_address')->textarea(['rows' => 3, 'placeholder' => "Residential Address"]) ?>

    <?= $form->field($model, 'court_address')->textarea(['rows' => 3, 'placeholder' => "Court Address"]) ?>

    <?= $form->field($model, 'blood_group')->dropDownList(yii\helpers\ArrayHelper::map(\common\models\BloodGroups::find()->all(), 'id', 'name'), ['prompt' => 'Please Select Blood Group']) ?>  
    
    <div class="col-sm-6">
    <?= $form->field($model, 'clerk_name')->textInput(['maxlength' => true, 'placeholder' => "Clerk Name"]) ?>
    </div>
    <div class="col-sm-6">
    <?= $form->field($model, 'clerk_contact')->textInput(['maxlength' => true, 'placeholder' => "Clerk Contact"]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?= $this->registerJs(
            '$(\'#mobile_plus_button\').on(\'click\', function(){             
                var html_content = \'<div class="mobile_no_container"><div class="col-lg-10">\' + $(this).parent().parent().find(\'.mobile_no_fields\').html() + \'</div><div class="col-lg-2"><div class="primary mobile_delete_button" >-</div></div></div>\';                
                $(\'.members_mobile_no\').append(html_content);
            });
            
            $(document).on(\'click\', \'.mobile_delete_button\', function(){
                $(this).parent().parent().remove();
            });
            '                        
    ); ?>
</div>
