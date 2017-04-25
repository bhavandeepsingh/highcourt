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
<div class="form-group">
    <div class="control-label col-sm-3"><label for="mobile-number">Mobile</label></div>
    <div class="col-sm-9"><?= \yii\helpers\Html::textInput('profile[mobile]', '', ["placeholder" => 'Mobile Number', 'id' => 'mobile-number' , 'class'=>"form-control"]) ?></div>
</div>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255,'placeholder' => 'Username']) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
