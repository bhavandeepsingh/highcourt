<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-view">

    <h1><?= Html::encode($this->title) ?></h1>
<head>
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
            'id',
            'title',
            'description:ntext',
            //'sender_id',
            //'reciever_id',
            [
                'label' => 'Created At',
                'value' => $model->getFormatedCreateAt(),
            ],
            [
                'label' => 'Updated At',
                'value' => $model->getFormatedUpdateAt(),
            ],
            [
                'label' => 'File',
                'format' => 'raw',
                'value' => function($data){
                    if($data->is_file){
                        return "<a class='btn btn-success' target='_blank' style='margin-bottom:10px;' href='".Yii::$app->urlManager->baseUrl."/../../uploads/notifications/".$data->id."/".$data->filename."?".time()."'>"
                             ."<span class='glyphicon glyphicon-download-alt'></span></a><div class='clearfix'></div>";
                    }else{ return "No file selected.";}
                }
            ],
        ],
    ]) ?>

</div>
