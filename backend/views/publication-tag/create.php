<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\entities\PublicationTag */

$this->title = 'Create Publication Tag';
$this->params['breadcrumbs'][] = ['label' => 'Publication Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
