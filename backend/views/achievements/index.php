<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AchievementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Achievements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievements-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Achievements'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'format' => 'html',
                'value' => function($data){ return $data->getImageTag(['width' => 100]);},
            ],
            'title:ntext',
            'destination:ntext',
            [                
                'attribute' => 'description',
                'value' => function($data){return $data->description; },
                'format' => 'html'
            ],
            [
                'attribute' => 'achievement_year',
                'value' => function($data){ return $data->getAchievementYear();}
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
