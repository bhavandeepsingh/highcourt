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
 * @var dektrium\user\models\User
 */
?>
<?= Yii::t('user', 'Your account for official of bar association has been created.') ?>
<?= Yii::t('user', 'Your username is') ?> <?= $user->username ?>
<?= Yii::t('user', 'And password is ') ?> <?= $user->password ?>
App can be downloaded from <a href="https://goo.gl/L1jNZX">Google Playstore</a> and IOS App from <a href="https://goo.gl/GrKfnO">IOS App Store</a>.
*official app
<?= Yii::t('user', 'You can download Android App from https://goo.gl/L1jNZX and IOS App from https://goo.gl/GrKfnO') ?>.

<?php if ($token !== null): ?>
<?= Yii::t('user', 'In order to complete your registration, please click the link below') ?>.

<?= $token->url ?>

<?= Yii::t('user', 'If you cannot click the link, please try pasting the text into your browser') ?>.
<?php endif ?>

<?= Yii::t('user', 'If you did not make this request you can ignore this email') ?>.