<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Achievements */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Achievements',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Achievements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="achievements-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
