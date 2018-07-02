<?php
namespace api\controllers;
use api\viewmodels\EriInPressListVM;
use api\viewmodels\EriInPressVM;
use common\repositories\EriInPressRepository;
use Yii;

class EriInPressController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $repoPublicationCategory;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 EriInPressRepository $repo,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->pageNumber = 1;
        $this->limit = 10;
        $this->offset = 10;
    }

    /**
     * @param int $languageId
     * @param int $pageNumber
     * @param int $limit
     * @param string $orderBy
     * @param string $query
     *
     * @return EriInPressListVM
     */
    public function actionIndex(
                                 int $languageId = 1,
                                 int $pageNumber = 1,
                                 int $limit = 10,
                                 string $orderBy = 'CreatedDate',
                                 string $query = ''
                                ): EriInPressListVM
    {

        $resultVMList = new EriInPressListVM();

        # FILTER: Pagination
        $this->pageNumber = $pageNumber;
        $this->limit = $limit;
        $this->offset = $this->limit * ($this->pageNumber - 1);


        # LIST
        $all = $this->repo->getAll( $languageId,
                                    $this->offset,
                                    $this->limit,
                                    $orderBy,
                                    $query
                                    );

        # View Models
        if( count($all) > 0 ){
            $resultVMList->PageNumber = $this->pageNumber;
            $resultVMList->TotalCount = $this->repo->count( $languageId );

            foreach ($all as $one){

                $oneVM = new EriInPressVM();
                $oneVM->Id = $one->Id;
                $oneVM->Title = $one->Title;
                $oneVM->Description = $one->Description;
                $oneVM->ImageId = $one->ImageId;
                $oneVM->LanguageId = $one->LanguageId;
                $oneVM->StatusId = $one->StatusId;
                $oneVM->CreatedDate =  date('F j, Y', strtotime($one->CreatedDate) );
                $oneVM->Link = $one->Link;

                # Dictionaries
                $oneVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');;
                $oneVM->Language = $one->language ? $one->language : null;
                $oneVM->Status = $one->status ? $one->status : null;

                $resultVMList->Items[] = $oneVM;
            }
        }

        return $resultVMList;
    }
}
