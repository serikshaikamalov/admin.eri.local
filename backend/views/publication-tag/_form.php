<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\PublicationTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Title')->textInput() ?>

    <?= $form->field($model, 'LanguageId')->textInput() ?>

    <?= $form->field($model, 'StatusId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
