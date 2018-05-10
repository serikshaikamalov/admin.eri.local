<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Title -->
    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>

    <!-- Short Description -->
    <?
    echo $form->field($vm->model, 'ShortDescription')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 100],
        'clientOptions' => [
            'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
            'height' => 400
        ]
    ]);
    ?>

    <!-- Description -->
    <?
    echo $form->field($vm->model, 'Description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 200],
        'clientOptions' => [
            'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
            'height' => 400
        ]
    ]);
    ?>

    <!-- Link -->
    <?= $form->field($vm->model, 'Link')->textInput(['maxlength' => true]) ?>

    <!-- Languages -->
    <? echo $form->field($vm->model, 'LanguageId')->dropDownList($vm->languages) ?>

    <!-- Button -->
    <div class="form-group">
        <?= Html::submitButton($vm->model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
