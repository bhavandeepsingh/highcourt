<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\MembershipTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subscription';
$this->params['breadcrumbs'][] = $this->title;
$templates="";
$templates.=(Yii::$app->user->can(USER_CAN_UPDATE_POSTS))?"{update} ":"";
$templates.=(Yii::$app->user->can(USER_CAN_DELETE_POSTS))?"{delete} ":"";
?>
<div class="membership-types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subscription Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'amount',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [0 => 'Inactive', 1 => 'Active'],
                'value' => function($data){
                    if($data->status){
                        return "Active";
                    }
                    return 'Inactive';
                }
            ],
            //'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} '.$templates
            ],
        ],
    ]); ?>
</div>
