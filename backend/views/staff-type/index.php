<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\staffTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Types';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <!-- Menu -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="/web/admin/staff" class="list-group-item list-group-item-action">Staff List</a>
            <a href="/web/admin/staff-type" class="list-group-item list-group-item-action active">Staff Types</a>
            <a href="/web/admin/staff-position" class="list-group-item list-group-item-action">Staff Positions</a>
        </div>
    </div>

    <!-- List -->
    <div class="col-md-9">
        <div class="staff-type-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Create Staff Type', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'filter' => \app\models\Status::getStatusList()
                    ],
                    [
                        'attribute' => 'LanguageId',
                        'label' => 'Language',
                        'value' => function($item){
                            return $item->language->Title;
                        },
                        'filter' => \app\models\Language::getLanguageList()
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
