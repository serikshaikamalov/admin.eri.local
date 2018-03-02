<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Events */

$this->title = 'Update Events: '.$eventFormViewModel->model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $eventFormViewModel->model->Title, 'url' => ['view', 'id' => $eventFormViewModel->model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="events-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'eventFormViewModel' => $eventFormViewModel
    ]) ?>

</div>
