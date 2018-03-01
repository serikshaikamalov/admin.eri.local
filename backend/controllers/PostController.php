<?php
namespace backend\controllers;
use common\repositories\PostRepository;
use yii\web\Controller;

class PostController extends Controller
{
    public $defaultAction = 'index';
    public $posts;

    public function __construct(string $id, $module, PostRepository $posts, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->posts = $posts;
    }


    /*
     * Post: List
     */
    public function actionIndex(){
        $model = $this->posts->getLatest();
        var_dump($model);
    }


    /*
     * Post: View
     */
    public function actionView($id){

        $model = $this->posts->get($id);

        return $this->render('view', [
           'model' => $model
        ]);
    }


}