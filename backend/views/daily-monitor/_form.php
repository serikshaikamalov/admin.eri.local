<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $vm common\viewmodels\DailyMonitorFormViewModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daily-monitor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($vm->model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($vm->model, 'Description')->textarea(['rows' => 6]) ?>

    <?= $form->field($vm->model, 'Link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($vm->model, 'IsActive')->checkbox($vm->statuses); ?>

    <?= $form->field($vm->model, 'LanguageId')->dropDownList( $vm->languages ); ?>

    <!-- Image -->
    <?
    echo $form->field($vm->model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
        'aspectRatio' => (16/9),
        'cropViewMode' => 1,
        'showPreview' => true,
        'showDeletePickedImageConfirm' => false
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
