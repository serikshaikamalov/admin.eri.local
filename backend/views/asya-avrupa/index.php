<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\entities\AsyaAvrupaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asya Avrupas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asya-avrupa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asya Avrupa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Title',
            'TitleSecond',
            'FileId',
            'InteractiveSrc',
            //'LanguageId',
            //'StatusId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
