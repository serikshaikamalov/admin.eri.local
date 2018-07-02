<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'Id',
            //'Title',
            [
                'attribute' => 'Title',
                'label' => 'Title',
                'contentOptions' => ['style' => 'max-width: 600px, white-space: normal'],
            ],
            [
                'attribute' => 'StatusId',
                'label' => 'Status',
                'value' => function( $item ){
                    return $item->status->Title;
                },
                'filter' => \common\entities\Status::getStatusList()
            ],
            [
                'attribute' => 'LanguageId',
                'label' => 'Language',
                'value' => function( $item ){
                    return $item->language->Title;
                },
                'filter' => \common\entities\Language::getLanguageList()
            ],
            //'ImageId',
            'CreatedDate:date',
            //'Hits',
            //'StatusId',
            //'LanguageId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
