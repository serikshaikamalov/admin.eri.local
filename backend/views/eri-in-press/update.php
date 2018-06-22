<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\EriInPress */

$this->title = 'Update Eri In Press: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Eri In Presses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eri-in-press-update">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
