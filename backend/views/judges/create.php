<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Judges */

$this->title = Yii::t('app', 'Create Judges');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Judges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judges-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
