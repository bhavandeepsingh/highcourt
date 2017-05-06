<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Members */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="members-view">

    <h1><img src="<?= \common\models\UploadForm::getMemberProfilePic($model->id) ?>" width="100"></h1>

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
            'name',
            'enrollment_no',
            'membership_no',
            'email_id:email',
            'landline_no:ntext',
            [
                'label' => 'Mobile No',
                'format' => 'html',
                'value' => implode(', &nbsp;', json_decode($model->mobile_no))
            ],
            'residential_address:ntext',
            'court_address:ntext',
            [
                'label' => 'Blood Group',
                'format' => 'ntext',
                'value' => @$model->bloodGroup->name
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
