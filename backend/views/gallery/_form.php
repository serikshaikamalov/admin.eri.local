<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dpodium\filemanager\widgets\FileBrowse;

/* @var $this yii\web\View */
/* @var $vm common\viewmodels\GalleryFormModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($vm->model, 'Description')->textarea(['rows' => 6]) ?>

    <?= $form->field($vm->model, 'StatusId')->checkbox( $vm->statuses ) ?>

    <?= $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages) ?>

    <?= $form->field($vm->model, 'CreatedDate')->input('date') ?>


    <!-- Images -->
    <?

//    echo $form->field($model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
//        'aspectRatio' => (16/9), //set the aspect ratio
//        'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
//        'showPreview' => true, //false to hide the preview
//        'showDeletePickedImageConfirm' => false, //on true show warning before detach image
//    ]);

    ?>


    <!-- Images -->
    <?php
    for ( $i=0; $i < 20; $i++ ){
        echo $form->field($vm->imageFormModel, 'image'.($i+1))->widget(FileBrowse::className(), [
            'multiple' => false
        ]);
    }

//        echo $form->field($vm->imageFormModel, 'image1')->widget(FileBrowse::className(), [
//            'multiple' => false
//        ]);
//
//        echo $form->field($vm->imageFormModel, 'image2')->widget(FileBrowse::className(), [
//            'multiple' => false
//        ]);
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
