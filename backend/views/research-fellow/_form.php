<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dpodium\filemanager\widgets\FileBrowse;

/* @var $this yii\web\View */
/* @var $model common\entities\ResearchFellow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-fellow-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--  Types -->
    <?= $form->field($vm->model, 'ResearchFellowTypeId')->dropDownList($vm->types); ?>

    <!--  Category -->
    <?= $form->field($vm->model, 'ResearchFellowCategoryId')->dropDownList($vm->categories); ?>

    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>

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

    <!-- Full Description -->
    <?
    echo $form->field($vm->model, 'FullDescription')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 200],
        'clientOptions' => [
            'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
            'height' => 200
        ]
    ]);
    ?>

    <? echo $form->field($vm->model, 'StatusId')->checkbox( $vm->statuses ) ?>

    <!-- LANGUAGE --->
    <? echo $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages) ?>

    <!-- IMAGE -->
    <?=
    $form->field($vm->model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
        'aspectRatio' => (16/9), //set the aspect ratio
        'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
        'showPreview' => true, //false to hide the preview
        'showDeletePickedImageConfirm' => false, //on true show warning before detach image
    ]);
    ?>


    <!-- FILE: PDF -->
    <?php
        echo $form->field($vm->model, 'FilePDFId')->widget(FileBrowse::className(), [
            'multiple' => false,
            'folderId' => 1
    ]);
    ?>

    <!-- FILE: WORD -->
    <?= $form->field($vm->model, 'FileWordId')->widget(FileBrowse::className(), [
        'multiple' => false,
        'folderId' => 1
    ]); ?>

    <!-- CREATED Date -->
    <?= $form->field($vm->model, 'CreatedDate')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?= FileBrowse::renderModal(); ?>

</div>
