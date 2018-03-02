<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\DailyMonitorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Monitors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-monitor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Daily Monitor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Title',
            [
                'attribute' => 'IsActive',
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
