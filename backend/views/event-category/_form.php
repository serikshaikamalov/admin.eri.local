<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $vm app\viewmodels\EventCategoryFormViewModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Title -->
    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>

    <!-- Published -->
    <?= $form->field($vm->model, 'StatusId')->dropDownList($vm->statuses ); ?>

    <!-- Language -->
    <?= $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages); ?>

    <!-- Parent -->
    <?= $form->field($vm->model, 'ParentId')->dropDownList($vm->parents, ['prompt' => 'Select Category']);  ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
