<?php

//var_dump( Yii::$app->request->getUserHost1 ); die();

$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
    defined('IMAGE_SERVER') or define('IMAGE_SERVER', 'http://static.eri.local');
    defined('ALLOWED_DOMAIN') or define('ALLOWED_DOMAIN', 'http://localhost:4200');
}else{
    defined('IMAGE_SERVER') or define('IMAGE_SERVER', 'http://static.gosmart.kz');
    defined('ALLOWED_DOMAIN') or define('ALLOWED_DOMAIN', 'http://eri-new.gosmart.kz');
}