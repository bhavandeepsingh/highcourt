<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\User $user
 */
?>

<?= $form->field($user, 'email')->textInput(['maxlength' => 255,'placeholder' => 'Email Id']) ?>
<?php /*<div class="col-sm-9 col-sm-offset-3" style="margin-bottom:20px; color:#dd4b39;">You need to fill either Mobile or Email</div> */ ?>
<?= $form->field($user, 'mobile')->textInput(['value' => @$user->profile->mobile,'maxlength' => 255,'placeholder' => 'Mobile']) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255,'placeholder' => 'Username']) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
