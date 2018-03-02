<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $vm app\viewmodels\StaffPositionFormViewModel */

$this->title = 'Update Staff Position: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Staff Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vm->model->Title, 'url' => ['view', 'id' => $vm->model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-position-update">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
