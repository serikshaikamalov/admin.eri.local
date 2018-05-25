<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\AsyaAvrupa */

$this->title = 'Update Asya Avrupa: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Asya Avrupas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asya-avrupa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
