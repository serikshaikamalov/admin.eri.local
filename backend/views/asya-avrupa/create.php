<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\entities\AsyaAvrupa */

$this->title = 'Create Asya Avrupa';
$this->params['breadcrumbs'][] = ['label' => 'Asya Avrupas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asya-avrupa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
