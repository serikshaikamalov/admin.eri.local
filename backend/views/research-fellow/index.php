<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\ResearchFellowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Research Fellows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-fellow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Research Fellow', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'researchFellowTypeId',
                'label' => 'Type',
                'value' => function( $item ){
                    return $item->researchFellowType->Title;
                },
                'filter' => \common\entities\ResearchFellowType::getResearchFellowTypeList()
            ],
            [
                'attribute' => 'researchFellowCategoryId',
                'label' => 'Category',
                'value' => function( $item ){
                    return $item->researchFellowCategory->Title;
                },
                'filter' => \common\entities\ResearchFellowCategory::getResearchFellowCategoryList()
            ],
            'Title',
            'CreatedDate:date',
            [
                'attribute' => 'CreatedBy',
                'label' => 'Author',
                'value' => function( $item ){
                    return \common\entities\User::findIdentity($item)->username;
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update} {delete}'],
        ],
    ]); ?>
</div>
