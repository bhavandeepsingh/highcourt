<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CaseLawSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Case Laws';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-law-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->can(USER_CAN_CREATE_POSTS)){ ?>
        <?= Html::a('Create Case Law', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title:ntext',
            'discription:ntext',
            [
                'label' => 'Created At',
                'value' => function($data){ return $data->getFormatedCreateAt(); },
            ],
            [
                'label' => 'Updated At',
                'value' => function($data){ return $data->getFormatedUpdateAt(); },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
