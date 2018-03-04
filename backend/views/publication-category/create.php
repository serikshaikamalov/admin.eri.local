<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $vm common\viewmodels\PublicationCategoryFormViewModel */

$this->title = 'Create Publication Category';
$this->params['breadcrumbs'][] = ['label' => 'Publication Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vm->model->Title;
?>
<div class="publication-category-create">

    <h1><?= Html::encode($vm->model->Title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
