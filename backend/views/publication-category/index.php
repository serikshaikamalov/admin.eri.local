<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\PublicationCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publication Categories';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <!-- Menu -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="/publication" class="list-group-item list-group-item-action">Publications</a>
            <a href="/publication-category" class="list-group-item list-group-item-action active">Publication Categories</a>
            <a href="/publication-tag" class="list-group-item list-group-item-action">Publication Tags</a>
        </div>
    </div>

    <!-- List -->
    <div class="col-md-9">
        <div class="publication-category-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Publication Category', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'Id',
                    'Title',
                    'ParentId',
                    'LanguageId',
                    'StatusId',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
