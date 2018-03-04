<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $vm common\viewmodels\PublicationCategoryFormViewModel*/
/* @var $model common\forms\PublicationCategoryForm*/
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($vm->form, 'Title')->textInput() ?>

    <?= $form->field($vm->form, 'ParentId')->dropDownList( $vm->publicationCategoryList ) ?>

    <?= $form->field($vm->form, 'LanguageId')->dropDownList( $vm->languages ) ?>

    <?= $form->field($vm->form, 'StatusId')->dropDownList( $vm->statuses ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
