<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\entities\DailyMonitor */

$this->title = 'Create Daily Monitor';
$this->params['breadcrumbs'][] = ['label' => 'Daily Monitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-monitor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'vm' => $vm,
    ]) ?>

</div>
