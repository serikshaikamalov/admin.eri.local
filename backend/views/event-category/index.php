<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <!-- Menu -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="/web/admin/event" class="list-group-item list-group-item-action">Event List</a>
            <a href="/web/admin/event-category" class="list-group-item list-group-item-action active">Event Category</a>
        </div>
    </div>

    <!-- List -->
    <div class="col-md-9">
        <div class="event-category-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Event Category', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Title',
                    [
                        'label' => 'Status',
                        'value' => function( $item ){
                            return $item->status->Title;
                        }
                    ],
                    [
                        'label' => 'Language',
                        'value' => function( $item ){
                            return $item->language->Title;
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>