<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dpodium\filemanager\widgets\FileBrowse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\entities\publication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Title -->
    <?
        echo $form->field($vm->model, 'Title')->textInput(['maxlength' => true])
    ?>

    <!--  Publication Type -->
    <?
        echo $form->field($vm->model, 'PublicationTypeId')->dropDownList($vm->publicationTypeList);
    ?>

    <!--  Publication Category -->
    <?
    echo $form->field($vm->model, 'PublicationCategoryId')->dropDownList($vm->publicationCategoryList)
    ?>

    <!--  Publication Main Tag -->
    <?
    echo $form->field($vm->model, 'PublicationMainTagId')->dropDownList($vm->publicationMainTagList);
    ?>

    <?= $form->field($vm->model, 'StaffId')->dropDownList($vm->staffList, ['prompt'=>'Select Author']) ?>

    <?= $form->field($vm->model, 'IsFeatured')->checkbox( ) ?>

    <?=
    $form->field($vm->model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
        'aspectRatio' => (16/9), //set the aspect ratio
        'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
        'showPreview' => true, //false to hide the preview
        'showDeletePickedImageConfirm' => false, //on true show warning before detach image
    ]);
    ?>

    <!-- Short Description -->
    <?
    echo $form->field($vm->model, 'ShortDescription')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 200],
        'clientOptions' => [
            'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
            'height' => 200
        ]
    ]);
    ?>

    <?
        echo $form->field($vm->model, 'Description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 200],
        'clientOptions' => [
            'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
            'height' => 400
        ]
    ]);
    ?>



    <?= $form->field($vm->model, 'StatusId')->checkbox( $vm->statuses ) ?>

    <?= $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages) ?>


    <!-- Created Date -->
    <?
    echo $form->field($vm->model, 'CreatedDate')->input('date')
    ?>


    <? # echo $form->field($vm->model, 'FileId')->textInput() ?>

    <!-- File -->
    <?php
        echo $form->field($vm->model, 'FileId')->widget(FileBrowse::className(), [
            'multiple' => false, // allow multiple upload
            'folderId' => 1 // set a folder to be uploaded to.
        ]);
    ?>

    <!-- Tags -->
    <?php
        echo $form->field( $vm->model, 'tagIds' )->widget(Select2::className(), [
            'model' => $vm->model,
            'data' => ArrayHelper::map(\common\entities\PublicationTag::find()->all(), 'Id', 'Title'),
            'options' => [
                'multiple' => true,
            ]
        ]);

    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <?php
        // !important: modal must be rendered after form
        echo FileBrowse::renderModal();
    ?>

</div>
