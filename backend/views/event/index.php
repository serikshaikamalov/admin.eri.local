<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <!-- Menu -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="/web/admin/event" class="list-group-item list-group-item-action active">Event List</a>
            <a href="/web/admin/event-category" class="list-group-item list-group-item-action">Event Category</a>
        </div>
    </div>

    <!-- List -->
    <div class="col-md-9">
        <div class="events-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Events', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Title',
                    'StartTime',
                    //'LangId',
                    [
                        'label' => 'Language',
                        'value' => function( $data ){
                            return $data->language->Title;
                        }
                    ],
                    [
                        'label' => 'Status',
                        'value' => function( $data ){
                            return $data->status->Title;
                        }
                    ],
                    //'StatusId',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
