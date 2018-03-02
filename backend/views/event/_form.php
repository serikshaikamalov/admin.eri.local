<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View
 * @var $eventFormViewModel app\viewmodels\EventFormViewModel
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Title -->
    <?= $form->field($eventFormViewModel->model, 'Title')->textInput(['maxlength' => true]) ?>

    <!-- Start Day -->
<!--    --><?//= $form->field($model, 'StartDay')->widget(\yii\jui\DatePicker::className(), [
//            'clientOptions' => ['defaultDate' => '2018-01-01'],
//            'dateFormat' => 'yyyy-MM-dd',
//    ])
//    ?>

    <!-- Start Day -->
    <?= $form->field($eventFormViewModel->model, 'StartDay')->input('date') ?>

    <!-- Start Time -->
    <?= $form->field($eventFormViewModel->model, 'StartTime')->input('time'); ?>

    <!-- Description -->
    <?
        echo $form->field($eventFormViewModel->model, 'Description')->widget(CKEditor::className(), [
            'options' => ['rows' => 200],
            'clientOptions' => [
                'filebrowserImageBrowseUrl' => yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'ckeditor']),
                'height' => 700
            ]
        ]);
    ?>

    <!-- Event Category -->
    <? echo $form->field($eventFormViewModel->model, 'EventCategoryId')->dropDownList( ArrayHelper::map($eventFormViewModel->eventCategories,'Id','Title'), [ 'prompt' => 'Select Category' ] ) ?>

    <!-- Languages -->
    <?
        echo $form->field($eventFormViewModel->model, 'LangId')->dropDownList( ArrayHelper::map($eventFormViewModel->languages,'Id','Title'), ['prompt' => 'Select Language'] )
    ?>

    <!-- Speaker -->
    <?= $form->field($eventFormViewModel->model, 'SpeakerFullName')->textInput(['maxlength' => true]) ?>

    <!-- Status -->
    <?
        echo $form->field($eventFormViewModel->model, 'StatusId')->checkbox(ArrayHelper::map($eventFormViewModel->statuses,'Id','Title'));
    ?>


    <!-- Address -->
    <?= $form->field($eventFormViewModel->model, 'Address')->textInput() ?>

    <!-- Link -->
    <?= $form->field($eventFormViewModel->model, 'Link')->textInput() ?>
    
    
    <!-- Image -->
    <?
        echo $form->field($eventFormViewModel->model, 'ImageId')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
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
