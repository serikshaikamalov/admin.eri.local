<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\PublicationTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($vm->model, 'Title')->textInput() ?>

    <?= $form->field($vm->model, 'TitleTR')->textInput() ?>

    <?= $form->field($vm->model, 'TitleRU')->textInput() ?>

    <?= $form->field($vm->model, 'TitleKZ')->textInput() ?>


    <!-- STATUS -->
    <? echo $form->field($vm->model, 'StatusId')->checkbox( $vm->statuses ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

