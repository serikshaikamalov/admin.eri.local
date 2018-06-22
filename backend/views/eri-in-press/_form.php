<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\EriInPress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eri-in-press-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>


    <!-- DESCRIPTION -->
    <?
        echo $form->field($vm->model, 'Description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 200],
            'clientOptions' => [
                'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
                'height' => 200
            ]
        ]);
    ?>

    <!-- IMAGE -->
    <?=
        $form->field($vm->model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
            'aspectRatio' => (16/9), //set the aspect ratio
            'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
            'showPreview' => true, //false to hide the preview
            'showDeletePickedImageConfirm' => false, //on true show warning before detach image
        ]);
    ?>


    <!-- CreatedDate -->
    <?= $form->field($vm->model, 'CreatedDate')->input('date') ?>

    <!-- STATUS -->
    <? echo $form->field($vm->model, 'StatusId')->checkbox( $vm->statuses ) ?>

    <!-- LANGUAGE --->
    <? echo $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages) ?>

    <?= $form->field($vm->model, 'Link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
