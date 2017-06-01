<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\JudgesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Judges');
$this->params['breadcrumbs'][] = $this->title;
$templates="";
$templates.=(Yii::$app->user->can(USER_CAN_UPDATE_POSTS))?"{update} ":"";
$templates.=(Yii::$app->user->can(USER_CAN_DELETE_POSTS))?"{delete} ":"";
?>
<div class="judges-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php if(Yii::$app->user->can(USER_CAN_CREATE_POSTS)){ ?>
        <?= Html::a(Yii::t('app', 'Create Judges'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Image',
                'format' => 'html',
                'value' => function($data){ 
                    return Html::img(\common\models\UploadForm::getJudgeProfilePic($data->id), ['width' => 100]);
                }
            ],
            //'name',
            [
                'label' => 'Name',
                'value' => function($data){return $data->nameWithSubtitle;},
            ],
            'address',
            [
                'attribute' => 'dob',
                'filter'    =>false,
            ],
            [
                'attribute' => 'date_of_appointment',
                'filter'    =>false,
            ],
            // 'date_of_retirement',
            // 'bio_graphy:ntext',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} '.$templates,
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
