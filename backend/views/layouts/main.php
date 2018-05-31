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
use yii\widgets\Menu;

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
        ['label' => 'Publications', 'url' => ['/publication/index']],
        ['label' => 'Research Group', 'url' => ['/research-group/index']],
        ['label' => 'Users', 'url' => ['/rbac/default/index']],
        ['label' => 'Staffs', 'url' => ['/staffindex/']],
        ['label' => 'Articles', 'url' => ['/post/index']],
        ['label' => 'Events', 'url' => ['/event/index']],
        ['label' => 'Daily Monitor', 'url' => ['/daily-monitor/index']],

        ['label' => 'Photo Manager', 'url' => ['/imagemanager/manager/index']],
        ['label' => 'File Manager', 'url' => ['/filemanager/files/index']],
        ['label' => 'Folders', 'url' => ['/filemanager/folders/index']],

        ['label' => 'Gallery', 'url' => ['/gallery/index']],
        ['label' => 'Video', 'url' => ['/video/index']],
        ['label' => 'Slider', 'url' => ['/slider/index']],
        ['label' => 'Asya Avrupa', 'url' => ['/asya-avrupa/index']],
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
        'options' => ['class' => 'navbar-nav'],
        'items' => Helper::filter($menuItems)
    ]);
    NavBar::end();
    ?>

    <div class="container">

            <?php
                echo Menu::widget([
                      'items' => [
                            // not just as 'controller' even if default action is used.
                            [
                               'label' => 'Neutral',
                               'url' => ['/language-switcher/set-language?languageId=0'],
                               'active'=> function() { return  Yii::$app->language == 0; },
                            ],
                            [
                                'label' => 'English',
                                'url' => ['/language-switcher/set-language?languageId=1'],
                                'active'=> function() { return  Yii::$app->language == 1; },
                            ],
                            [
                                'label' => 'Turkish',
                                'url' => ['/language-switcher/set-language?languageId=2'],
                                'active'=> function() { return  Yii::$app->language == 2; },
                            ],
                            [
                                'label' => 'Russian',
                                'url' => ['/language-switcher/set-language?languageId=3'],
                                'active'=> function() { return  Yii::$app->language == 3; },
                            ],
                            [
                                'label' => 'Kazakh',
                                'url' => ['/language-switcher/set-language?languageId=4'],
                                'active'=> function() { return  Yii::$app->language == 4; },
                            ],


                    ],
                    'options' => array( 'class' => 'list-inline pull-right' )
                ])




            ?>

        
        
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
