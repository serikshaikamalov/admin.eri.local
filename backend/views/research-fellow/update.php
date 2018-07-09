<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\ResearchFellow */

$this->title = 'Update Research Fellow: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Research Fellows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vm->model->Title, 'url' => ['view', 'id' => $vm->model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="research-fellow-update">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
