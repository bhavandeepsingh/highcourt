<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Holidays';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holidays-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Holidays', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        $templates="";
        $templates.=(Yii::$app->user->can(USER_CAN_UPDATE_POSTS))?"{update} ":"";
        $templates.=(Yii::$app->user->can(USER_CAN_DELETE_POSTS))?"{delete} ":"";
    ?>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'description:ntext',
            'date',
            //'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return ($data->status)?"True":"False"; 
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} '.$templates,
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
