<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\Gallery */

$this->title = 'Update Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
