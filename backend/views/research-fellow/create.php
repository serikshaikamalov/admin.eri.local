<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\entities\ResearchFellow */

$this->title = 'Create Research Fellow';
$this->params['breadcrumbs'][] = ['label' => 'Research Fellows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-fellow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
