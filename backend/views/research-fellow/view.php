<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\entities\ResearchFellow */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Research Fellows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-fellow-view">

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
            'researchFellowType',
            'researchFellowCategoryId',
            'Title',
            'ShortDescription',
            'FullDescription:ntext',
            'ImageId',
            'FilePDFId',
            'FileWordId',
            'CreatedDate',
            'CreatedBy',
        ],
    ]) ?>

</div>
