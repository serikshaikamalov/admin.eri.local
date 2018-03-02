<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\staffType */

$this->title = 'Update Staff Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Staff Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-type-update">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
