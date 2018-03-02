<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\controllers\Helper;

/* @var $this yii\web\View */
/* @var $vm app\viewmodels\EventCategoryViewModel */

$this->title = $vm->Title;
$this->params['breadcrumbs'][] = ['label' => 'Event Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->Title;
?>

<div class="event-category-view">

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
            [
                'label' => 'Event Category ID',
                'value' => $vm->Id
            ],
            'Title',
            [
                'label' => 'Status',
                'value' => $vm->Status->Title
            ],
            [
                'label' => 'Parent Category',
                'value' => $vm->Parent->Title
            ],
            [
                'label' => 'Language',
                'value' => $vm->Language->Title
            ],
        ],
    ]) ?>

</div>