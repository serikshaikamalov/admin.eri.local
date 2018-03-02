<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'IsActive') ?>

    <?= $form->field($model, 'FullName') ?>

    <?= $form->field($model, 'PositionTitle') ?>

    <?php // echo $form->field($model, 'ResearchGroupTitle') ?>

    <?php // echo $form->field($model, 'ShortBiography') ?>

    <?php // echo $form->field($model, 'AvatarPath') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
