<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MembershipTypes */

$this->title = 'Create Membership Types';
$this->params['breadcrumbs'][] = ['label' => 'Membership Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
