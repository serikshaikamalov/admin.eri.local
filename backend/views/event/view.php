<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $eventViewModel app\viewmodels\EventViewModel */

$this->title = $eventViewModel->Title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $eventViewModel->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $eventViewModel->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $eventViewModel,
        'attributes' => [
            'Id',
            'Title',
            'StartDay',
            'StartTime',
            'Description:html',
            'SpeakerFullName',
            [
                'label' => 'Category',
                'value' => $eventViewModel->EventCategory->Title
            ],
            //'EventCategoryId',
            'Address',
            'Image:image',
            'Link',
            [
                'label' => 'Language',
                'value' => $eventViewModel->Language->Title
            ],
            [
                'label' => 'CreatedBy',
                'value' => $eventViewModel->CreatedBy->username
            ],
            'CreatedDate',
            'UpdatedDate',
            [
                'label' => 'Status',
                'value' => $eventViewModel->Status->Title
            ]
        ],
    ]) ?>

</div>
