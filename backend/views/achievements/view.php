<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Achievements */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Achievements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievements-view">

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
            'title:ntext',
            'destination:ntext',
            [
                'attribute' => 'description',
                'value' => $model->description,
                'format' => 'html'
            ],
            [
                'label' => 'Achievement Year',
                'value' => $model->getAchievementYear()
            ],
            [
                'label' => 'Image',
                'format' => 'html',
                'value' => $model->getImageTag(['width' => 70])
            ]
            
        ],
    ]) ?>

</div>
