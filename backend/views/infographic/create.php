<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\entities\Infographic */

$this->title = 'Create Infographic';
$this->params['breadcrumbs'][] = ['label' => 'Infographics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->model->Title;
?>
<div class="infographic-create">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
