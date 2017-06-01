<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Roster */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rosters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roster-view">

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
            //'id',
            'title:ntext',
            [
                'attribute' => 'description',
                'format' => 'raw',
                'value' => @$model->description,
            ],
            [
                'label' => 'Bench Name',
                'value' => @$model->bench->name
            ],
            [
                'label' => 'Judges',
                'value' => @$model->judgesString
            ],
            [
                'label' => 'Date',
                'value' => @$model->date
            ],
            [
                'label' => 'Created At',
                'value' => $model->getFormatedCreateAt(),
            ],
            [
                'label' => 'Update At',
                'value' => $model->getFormatedUpdateAt(),
            ],
            
        ],
    ]) ?>

</div>
