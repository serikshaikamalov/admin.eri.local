<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\EriInPressSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eri-in-press-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'Description') ?>

    <?= $form->field($model, 'ImageId') ?>

    <?= $form->field($model, 'CreatedDate') ?>

    <?php // echo $form->field($model, 'StatusId') ?>

    <?php // echo $form->field($model, 'LanguageId') ?>

    <?php // echo $form->field($model, 'Link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
