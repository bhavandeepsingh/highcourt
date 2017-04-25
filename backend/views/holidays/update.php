<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Holidays */

$this->title = 'Update Holidays: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="holidays-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
