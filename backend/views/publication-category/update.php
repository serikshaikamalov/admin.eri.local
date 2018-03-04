<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\PublicationCategory */

$this->title = 'Update Publication Category: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Publication Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publication-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
