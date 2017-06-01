<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Holidays';
$this->params['breadcrumbs'][] = $this->title;
$templates="";
$templates.=(Yii::$app->user->can(USER_CAN_UPDATE_POSTS))?"{update} ":"";
$templates.=(Yii::$app->user->can(USER_CAN_DELETE_POSTS))?"{delete} ":"";
?>
<div class="holidays-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if(Yii::$app->user->can(USER_CAN_CREATE_POSTS)){ ?>
        <?= Html::a('Create Holidays', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'title',
            [
                'label' => 'Description',
                'value' => function($data){ return substr($data->description,0,60);}
            ],
            [
                'label' => 'Holiday In',
                'value' => function($data){ return $data->holidayNames;},
            ],
            
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
