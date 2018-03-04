<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $vm common\viewmodels\PublicationFormViewModel*/

$this->title = 'Create Publication';
$this->params['breadcrumbs'][] = ['label' => 'Publications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->model->Title;
?>
<div class="publication-create">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
