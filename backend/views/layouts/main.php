<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use mdm\admin\components\Helper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>ERI: Admin Panel</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <!-- Main menu -->
    <?php

    $menuItems = [
        ['label' => 'Dashboard', 'url' => ['/default']],
        ['label' => 'Publications', 'url' => ['/publication/']],
        ['label' => 'Research Group', 'url' => ['/research-group/']],
        ['label' => 'Пользователи', 'url' => ['/rbac/default/index']],
        ['label' => 'Staffs', 'url' => ['/staff/']],
        ['label' => 'Статьи', 'url' => ['/post/']],
        ['label' => 'Events', 'url' => ['/event/']],
        ['label' => 'Daily Monitor', 'url' => ['/daily-monitor/']],
        ['label' => 'Media Manager', 'url' => ['/imagemanager/manager']],
    ];

    if( Yii::$app->user->isGuest ){
        array_push( $menuItems,  ['label' => 'Login', 'url' => ['/site/login']]);
    }else{
        array_push( $menuItems,  ['label' =>  'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout']]);
    }



    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => Helper::filter($menuItems)
    ]);
    NavBar::end();
    ?>

    <div class="container">
        
        <!-- Languages -->
        <ul>
            <li>
                <a href="/language-switcher/set-language?languageTag=en" >English</a>
            </li>
            <li>
                <a href="/language-switcher/set-language?languageTag=tr">Turkish</a>
            </li>
            <li>
                <a href="/language-switcher/set-language?languageTag=ru">Russian</a>
            </li>
            <li>
                <a href="/language-switcher/set-language?languageTag=kz">Kazakh</a>
            </li>
        </ul>

        <pre>
            Language => <?php echo $_SESSION['languageTag']; ?>
        </pre>
        
        
        <!-- Breadcrumb -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <!-- Alert -->
        <?= Alert::widget() ?>

        <!-- Content -->
        <?= $content ?>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; GoSmart <?= date('Y') ?></p>

        <p class="pull-right">GoSmart Company</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
