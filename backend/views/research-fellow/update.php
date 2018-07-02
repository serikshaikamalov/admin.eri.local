<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\ResearchFellow */

$this->title = 'Update Research Fellow: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Research Fellows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="research-fellow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
