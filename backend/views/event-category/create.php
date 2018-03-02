<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EventCategory */

$this->title = 'Create Event Category';
$this->params['breadcrumbs'][] = ['label' => 'Event Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm
    ]) ?>

</div>
