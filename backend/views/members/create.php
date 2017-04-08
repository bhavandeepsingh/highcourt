<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JudgesExecutives */

$this->title = 'Create Judges Executives';
$this->params['breadcrumbs'][] = ['label' => 'Judges Executives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judges-executives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
