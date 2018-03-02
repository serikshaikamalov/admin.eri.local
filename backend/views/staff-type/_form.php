<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $vm app\viewmodels\StaffTypeFormViewModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($vm->model, 'StatusId')->dropDownList( $vm->statuses ) ?>

    <?= $form->field($vm->model, 'LanguageId')->dropDownList( $vm->languages ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
