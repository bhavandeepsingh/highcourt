<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CaseLaw */

$this->title = 'Update Case Law: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Case Laws', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="case-law-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
