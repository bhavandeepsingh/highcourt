<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Profile $profile
 */
?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

<?= $form->field($profile, 'name')->textInput(['placeholder' => 'Name']) ?>
<?= $form->field($profile, 'public_email')->textInput(['placeholder' => 'Email Address']) ?>
<?php //$form->field($profile, 'website') ?>
<?= $form->field($profile, 'location')->textInput(['placeholder' => 'Location']) ?>
<?php //$form->field($profile, 'gravatar_email') ?>
<?= $form->field($profile, 'bio')->textarea(['placeholder' => 'About Member']) ?>
<?= $form->field($profile, 'designation')->dropDownList(['' => 'Select Designation',1 => 'Advocate', 2 => 'Additional Advocate']) ?>
<?= $form->field($profile, 'profile')->textInput(['placeholder' => 'Profile Name (eg. Additonal Advocate General, Haryana)']) ?>
<?= $form->field($profile, 'enrollment_number')->textInput(['placeholder' => 'Enrollment Number']) ?>
<?= $form->field($profile, 'membership_number')->textInput(['placeholder' => 'Membership Number']) ?>
<?= $form->field($profile, 'landline')->textInput(['placeholder' => 'Landline Number']) ?>
<?= $form->field($profile, 'mobile')->textInput(['placeholder' => 'Mobile Number']) ?>
<?= $form->field($profile, 'residential_address')->textarea(['placeholder' => 'Enter Residential Address Here']) ?>
<?= $form->field($profile, 'court_address')->textarea(['placeholder' => 'Enter Court Address Here']) ?>
<?= $form->field($profile, 'blood_group')->textInput(['placeholder' => 'Blood Group']) ?>
<?= $form->field($profile, 'lat1')->textInput(['placeholder' => 'Enter Latitude Home (If want to add manually)']) ?>
<?= $form->field($profile, 'long1')->textInput(['placeholder' => 'Enter Longitude Home  (If want to add manually)']) ?>
<?= $form->field($profile, 'lat2')->textInput(['placeholder' => 'Enter Latitude Office  (If want to add manually)']) ?>
<?= $form->field($profile, 'long2')->textInput(['placeholder' => 'Enter Longitude Office  (If want to add manually)']) ?>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
