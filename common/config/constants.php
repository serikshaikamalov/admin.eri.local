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
    defined('FILE_SERVER') or define('FILE_SERVER', 'http://admin.eri.local/web');
    defined('ALLOWED_DOMAIN') or define('ALLOWED_DOMAIN', 'http://localhost:4200');
}else{
    defined('IMAGE_SERVER') or define('IMAGE_SERVER', 'http://static.eurasian-research.org');
    defined('FILE_SERVER') or define('FILE_SERVER', 'http://backend.eurasian-research.org/web');
    defined('ALLOWED_DOMAIN') or define('ALLOWED_DOMAIN', 'http://eurasian-research.org');
}