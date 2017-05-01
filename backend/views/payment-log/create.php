<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PaymentLog */

$this->title = 'Create Payment Log';
$this->params['breadcrumbs'][] = ['label' => 'Payment Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
