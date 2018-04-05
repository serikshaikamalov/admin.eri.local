<?php
namespace api\controllers;
use api\viewmodels\ArticleVM;
use common\repositories\ArticleRepository;

class ArticlesController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;

    public function  __construct(string $id,
                                 $module,
                                 ArticleRepository $repo,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }

    /**
     * Article by its url
     *
     * @param $languageId
     * @param $link
     *
     * @return  ArticleVM
     */
    public function actionViewByLink( int $languageId, string $link ): ArticleVM
    {
        // Repo
        $one = $this->repo->getByUrl( $languageId, $link );

        // ViewModel
        $oneVM = new ArticleVM();

        if( $one ){
            $oneVM->Id = $one->Id;
            $oneVM->Title = $one->Title;
            $oneVM->Description = $one->Description;
            $oneVM->LanguageId = $one->LanguageId;
            $oneVM->Link = $one->Link;
        }
        return $oneVM;
    }
}
