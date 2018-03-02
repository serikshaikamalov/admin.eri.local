<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $vm app\viewmodels\StaffFormViewModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($vm->model, 'FullName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($vm->model, 'ShortBiography')->textarea(['rows' => 6]) ?>

    <? echo $form->field($vm->model, 'StaffTypeId')->dropDownList($vm->staffTypes) ?>

    <? echo $form->field($vm->model, 'StaffPositionId')->dropDownList($vm->staffPositions) ?>


    <? echo $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages) ?>

    <? //echo $form->field($vm->model, 'ResearchGroupTitle')->textInput(['maxlength' => true]) ?>




    <?=
        $form->field($vm->model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
            'aspectRatio' => (16/9), //set the aspect ratio
            'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
            'showPreview' => true, //false to hide the preview
            'showDeletePickedImageConfirm' => false, //on true show warning before detach image
        ]);
    ?>

    <? echo $form->field($vm->model, 'StatusId')->checkbox( $vm->statuses ) ?>

    <div class="form-group">
        <?= Html::submitButton($vm->model->isNewRecord ? 'Create' : 'Update', ['class' => $vm->model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
