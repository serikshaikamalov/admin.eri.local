<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\publication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PublicationCategoryId')->textInput() ?>

    <?= $form->field($model, 'StaffId')->textInput() ?>

<!--    --><?//= $form->field($model, 'CreatedDate')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'CreatedBy')->textInput() ?>

    <?= $form->field($model, 'IsFeatured')->textInput() ?>

    <?= $form->field($model, 'ImageId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ShortDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ViewsCount')->textInput() ?>

    <?= $form->field($model, 'StatusId')->textInput() ?>

    <?= $form->field($model, 'LanguageId')->textInput() ?>

    <?= $form->field($model, 'FileId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
