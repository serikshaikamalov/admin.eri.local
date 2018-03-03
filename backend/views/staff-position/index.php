<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StaffPositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Positions';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <!-- Menu -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="/staff" class="list-group-item list-group-item-action">Staff List</a>
            <a href="/staff-type" class="list-group-item list-group-item-action">Staff Types</a>
            <a href="/staff-position" class="list-group-item list-group-item-action active">Staff Positions</a>
        </div>
    </div>

    <!-- List -->
    <div class="col-md-9">
        <div class="staff-position-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Staff Position', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'Title',
                    [
                        'attribute' => 'StatusId',
                        'label' => 'Status',
                        'value' => function($item){
                            return $item->status->Title;
                        },
                        'filter' => \common\entities\Status::getStatusList()
                    ],
                    [
                        'attribute' => 'LanguageId',
                        'label' => 'Language',
                        'value' => function($item){
                            return $item->language->Title;
                        },
                        'filter' => \common\entities\Language::getLanguageList()
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
