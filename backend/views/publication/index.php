<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\publicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Publication', ['create'], ['class' => 'btn btn-success']) ?>
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
