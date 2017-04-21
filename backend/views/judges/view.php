<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Judges */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Judges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judges-view">

    <h1><?= Html::img(\common\models\UploadForm::getJudgeProfilePic($model->id), ['width' => 100]) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can("deletePost")): echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]); endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
            'dob',
            'date_of_appointment',
            'date_of_retirement',
            'bio_graphy:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
