<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EventCategory */

$this->title = 'Update Event Category: '.$vm->model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Event Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vm->model->Title, 'url' => ['view', 'id' => $vm->model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
