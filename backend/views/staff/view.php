<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $vm app\viewmodels\StaffViewModel */

$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->FullName;
?>
<div class="staff-view">

    <h1><?= Html::encode($vm->FullName) ?></h1>

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
            //'StatusId',
            [
                'label' => 'Status',
                'value' => $vm->Status->Title
            ],
            'FullName',
            //'StaffPositionId',
            [
                'label' => 'Position',
                'value' => $vm->StaffPosition->Title
            ],
            'ResearchGroupId',
            'ShortBiography:ntext',
            'Image:image',
        ],
    ]) ?>

</div>
