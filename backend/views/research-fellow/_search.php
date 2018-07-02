<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\ResearchFellowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-fellow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'researchFellowType') ?>

    <?= $form->field($model, 'researchFellowCategoryId') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'ShortDescription') ?>

    <?php // echo $form->field($model, 'FullDescription') ?>

    <?php // echo $form->field($model, 'ImageId') ?>

    <?php // echo $form->field($model, 'FilePDFId') ?>

    <?php // echo $form->field($model, 'FileWordId') ?>

    <?php // echo $form->field($model, 'CreatedDate') ?>

    <?php // echo $form->field($model, 'CreatedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
