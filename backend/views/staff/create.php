<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $vm app\viewmodels\StaffFormViewModel */

$this->title = 'Create Staff';
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->model->FullName;
?>
<div class="staff-create">

    <h1><?= Html::encode($vm->model->FullName) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
