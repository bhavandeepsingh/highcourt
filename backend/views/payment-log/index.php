<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            [
                'attribute' => 'user_id',
                'label' => 'User',
                'format' => 'html',
                'filter'    =>  false,
                'value' => function($data){ 
                    return $data->user->name;
                }
            ],
            //'payment_type',
            [
                'attribute' => 'payment_type',
                'label' => 'Payment Type',
                'format' => 'html',
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\MembershipTypes::find()->all(), "id", "name"),
                'value' => function($data){ 
                    return $data->type->name;
                }
            ],
            //'payment_token',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'format' => 'raw',
                'filter' => [
                    0 => "Init",
                    1 => "Success",
                    2 => "Abort",
                    3 => "Failure",
                    4 => "Illegal",
                    5 => "Error",
                    6 => "Cancel",
                ],
                'value' => function($data){ 
                    switch ($data->status){
                        case 0:
                            return "Init";
                            break;
                        case 1:
                            return "Success";
                            break;
                    }
                }
            ],
            //'status',
            // 'response:ntext',
            //'created_at',
            [
                'attribute' => 'created_at',
                'label' => 'Created At',
                'format' => 'html',
                'filter' => false,
                'value' => function($data){ 
                    return $data->getFormatedCreateAt();
                }
            ],
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
