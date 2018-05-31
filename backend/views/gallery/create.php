<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\entities\Gallery */

$this->title = 'Create Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
