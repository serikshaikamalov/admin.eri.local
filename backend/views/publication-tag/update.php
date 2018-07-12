<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\PublicationTag */

$this->title = 'Update Publication Tag: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Publication Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vm->model->Title, 'url' => ['view', 'id' => $vm->model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publication-tag-update">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
