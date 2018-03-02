<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StaffPosition */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Staff Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-position-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Title',
            [
                'label' => 'Status',
                'value' => $model->status->Title
            ],
            [
                'label' => 'Language',
                'value' => $model->language->Title
            ],
        ],
    ]) ?>

</div>
