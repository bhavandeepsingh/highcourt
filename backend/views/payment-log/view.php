<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payment Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if(Yii::$app->user->can("updatePost")):
                echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            endif;
            if(Yii::$app->user->can("deletePost")): echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'payment_type',
            //'payment_token',
            'status',
            'response:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
