<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $vm common\viewmodels\DailyMonitorFormViewModel */

$this->title = 'Update Daily Monitor: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Daily Monitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vm->model->Title, 'url' => ['view', 'id' => $vm->model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="daily-monitor-update">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
