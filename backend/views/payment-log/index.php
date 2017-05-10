<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PaymentLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    /*
    ?>

    <p>
        <?= Html::a('Create Payment Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p> */ ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'payment_type',
            //'payment_token',
            'status',
            // 'response:ntext',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '',
            ],
        ],
    ]); ?>
</div>
