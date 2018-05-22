<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $vm common\viewmodels\VideoFormViewModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($vm->model, 'Description')->textarea(['rows' => 5]) ?>

    <?= $form->field($vm->model, 'Url')->textInput(['maxlength' => true]) ?>

    <? echo $form->field($vm->model, 'StatusId')->checkbox( $vm->statuses ) ?>

    <? echo $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages) ?>

    <?= $form->field($vm->model, 'CDate')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>