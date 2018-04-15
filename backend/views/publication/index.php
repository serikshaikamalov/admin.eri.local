<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\publicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publications';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <!-- Menu -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="/publication" class="list-group-item list-group-item-action active">Publications</a>
            <a href="/publication-category" class="list-group-item list-group-item-action">Publication Categories</a>
            <a href="/publication-tag" class="list-group-item list-group-item-action">Publication Tags</a>
        </div>
    </div>

    <!-- List -->
    <div class="col-md-9">
        <div class="publication-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Publication', ['create?languageId=3'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'Id',
                    'Title',
                    'PublicationCategoryId',
                    'StaffId',
                    'CreatedDate',
                    //'CreatedBy',
                    //'IsFeatured',
                    //'ImageId',
                    //'Description:ntext',
                    //'ShortDescription:ntext',
                    //'ViewsCount',
                    //'StatusId',
                    //'LanguageId',
                    //'FileId',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>

