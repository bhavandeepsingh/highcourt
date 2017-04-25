<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MembershipTypes */

$this->title = 'Create Subscription';
$this->params['breadcrumbs'][] = ['label' => 'Subscription', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
