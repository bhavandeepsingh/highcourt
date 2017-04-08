<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JudgesExecutives */

$this->title = 'Update Judges Executives: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Judges Executives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="judges-executives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
