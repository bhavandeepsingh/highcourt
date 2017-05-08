<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CaseLaw */

$this->title = 'Create Case Law';
$this->params['breadcrumbs'][] = ['label' => 'Case Laws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-law-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
