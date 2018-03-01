<?php
namespace api\controllers;
use common\repositories\PostRepository;
use \yii\rest\Controller;


class PostController extends Controller
{
    public $posts;

    public function __construct(string $id, $module, PostRepository $posts , array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->posts = $posts;
    }


    public function actionGetLatest(){

        if(!$posts = $this->posts->getLatest()){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $posts;
    }


    public function actionGet( $id ){

        if(!$post = $this->posts->get( $id )){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $post;
    }





}