<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $vm app\viewmodels\StaffPositionFormViewModel */

$this->title = 'Create Staff Position';
$this->params['breadcrumbs'][] = ['label' => 'Staff Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->model->Title;
?>
<div class="staff-position-create">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
