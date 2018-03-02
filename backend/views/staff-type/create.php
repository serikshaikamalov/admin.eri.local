<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\staffType */

$this->title = 'Create Staff Type';
$this->params['breadcrumbs'][] = ['label' => 'Staff Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->model->Title;
?>
<div class="staff-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
