<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BenchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Benches');
$this->params['breadcrumbs'][] = $this->title;
$templates="";
$templates.=(Yii::$app->user->can(USER_CAN_UPDATE_POSTS))?"{update} ":"";
$templates.=(Yii::$app->user->can(USER_CAN_DELETE_POSTS))?"{delete} ":"";
?>
<div class="benches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->can(USER_CAN_CREATE_POSTS)){ ?>
        <?= Html::a(Yii::t('app', 'Create Benches'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name:ntext',
//            [
//                'label' => 'Bench Type',
//                'value' => function($data){return $data->getBenchTypes()[$data->type];}
//            ],
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} '.$templates
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
