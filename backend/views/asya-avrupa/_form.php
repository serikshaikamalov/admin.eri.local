<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dpodium\filemanager\widgets\FileBrowse;

/* @var $this yii\web\View */
/* @var $model common\entities\AsyaAvrupa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asya-avrupa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TitleSecond')->textInput(['maxlength' => true]) ?>

    <? #echo $form->field($model, 'FileId')->textInput() ?>


    <?= $form->field($model, 'InteractiveSrc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LanguageId')->textInput() ?>

    <?= $form->field($model, 'StatusId')->textInput() ?>

    <!-- File -->
    <?php
    echo $form->field($model, 'FileId')->widget(FileBrowse::className(), [
        'multiple' => false, // allow multiple upload
        'folderId' => 1 // set a folder to be uploaded to.
    ]);
    ?>

    <!-- Image -->
    <?=
    $form->field($model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
        'aspectRatio' => (16/9), //set the aspect ratio
        'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
        'showPreview' => true, //false to hide the preview
        'showDeletePickedImageConfirm' => false, //on true show warning before detach image
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
