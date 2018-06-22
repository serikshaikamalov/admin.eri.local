<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\entities\EriInPress */

$this->title = 'Create Eri In Press';
$this->params['breadcrumbs'][] = ['label' => 'Eri In Presses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eri-in-press-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
