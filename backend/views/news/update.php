<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\News */

$this->title = 'Update News: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vm->model->Title, 'url' => ['view', 'id' => $vm->model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">

    <h1>UPDATE: <?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
