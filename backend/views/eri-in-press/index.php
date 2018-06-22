<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\EriInPressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eri In Presses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eri-in-press-index">

    <h1>ERI In Press</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eri In Press', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Title',
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
            'CreatedDate:date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
