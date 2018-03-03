<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\publicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'PublicationCategoryId') ?>

    <?= $form->field($model, 'StaffId') ?>

    <?= $form->field($model, 'CreatedDate') ?>

    <?php // echo $form->field($model, 'CreatedBy') ?>

    <?php // echo $form->field($model, 'IsFeatured') ?>

    <?php // echo $form->field($model, 'ImageId') ?>

    <?php // echo $form->field($model, 'Description') ?>

    <?php // echo $form->field($model, 'ShortDescription') ?>

    <?php // echo $form->field($model, 'ViewsCount') ?>

    <?php // echo $form->field($model, 'StatusId') ?>

    <?php // echo $form->field($model, 'LanguageId') ?>

    <?php // echo $form->field($model, 'FileId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
