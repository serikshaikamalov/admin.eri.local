<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\entities\PublicationCategory */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Publication Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-category-view">

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
            //[],
            'ParentId',
            [
                'label' => 'Language',
                'value' => $model->language->Title
            ],
            //'LanguageId',
            [
                'label' => 'StatusId',
                'value' => $model->status->Title
            ],
        ],
    ]) ?>

</div>
