<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\entities\DailyMonitor */

$this->title = $vm->Title;
$this->params['breadcrumbs'][] = ['label' => 'Daily Monitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->title;
?>
<div class="daily-monitor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $vm->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $vm->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $vm,
        'attributes' => [
            'Id',
            'Title',
            'Description:ntext',
            'Link',
            [
                'label' => 'Language',
                'value' => $vm->Language->Title
            ],
            'Image:image',
            [
                'label' => 'Author',
                'value' => $vm->Author->username
            ],
            'CreatedDate',
            [
                'label' => 'Status',
                'value' => $vm->Status->Title

            ]
        ],
    ]) ?>

</div>
