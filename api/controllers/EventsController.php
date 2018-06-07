<?php
namespace api\controllers;

use common\repositories\EventCategoryRepository;
use Yii;
use common\repositories\EventRepository;
use common\entities\Event;
use api\viewmodels\ItemListVM;
use api\viewmodels\EventVM;
use yii\helpers\ArrayHelper;

class EventsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $eventCategoryRepo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 EventRepository $repo,
                                 EventCategoryRepository $eventCategoryRepo,
                                 array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->eventCategoryRepo = $eventCategoryRepo;
        $this->pageNumber = 1;
        $this->limit = 10;
        $this->offset = 10;
    }

    /**
     * @param int  $languageId
     * @param int $eventTypeId
     * @param int $eventCategoryId
     * @param int $pageNumber
     * @param int $limit
     * @param string $query
     *
     * @return ItemListVM
     */
    public function actionIndex( int $languageId = 1,
                                int $eventTypeId = 1,
                                int $eventCategoryId = 0,
                                int $pageNumber = 1,
                                int $limit = 10,
                                string $query = '' ): ItemListVM
    {
        $resultVMList = new ItemListVM();


        // FILTER: Pagination
        $this->pageNumber = $pageNumber;
        $this->limit = $limit;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        // FILTER: Category
        $childrenIds = [];
        if( $eventCategoryId != 0 ){
            $childrenIds = $this->eventCategoryRepo->getChildren($eventCategoryId);
            $childrenIds = ArrayHelper::getColumn($childrenIds, 'Id');
            $childrenIds[] = $eventCategoryId;
        }

        // EVENT: List
        $all = $this->repo->getAll( $languageId,
                                    $eventTypeId,
                                    $childrenIds,
                                    $this->offset,
                                    $this->limit,
                                    'Id',
                                    $query );


        // View Models
        if( count($all) > 0 ){
            foreach ($all as $one ){
                $oneVM = new EventVM();
                $oneVM->Id = $one->Id;
                $oneVM->Title = $one->Title;
                $oneVM->StartDate = $one->StartDate;
                $oneVM->ShortDescription = $one->ShortDescription;
                $oneVM->FullDescription = $one->FullDescription;
                $oneVM->EventCategoryId = $one->EventCategoryId;
                $oneVM->LanguageId = $one->LanguageId;
                $oneVM->SpeakerFullName = $one->SpeakerFullName;

                // Dictionary
                //$oneVM->EventCategory = $one->eventCategory;

                $resultVMList->ItemList[] = $oneVM;
            }
        }

        // Event: Count
        $this->totalCount = $this->repo->count( $languageId,
                                                $eventTypeId,
                                                $childrenIds,
                                                $query
                                            );
        $resultVMList->TotalCount = $this->totalCount;
        $resultVMList->PageNumber = $this->pageNumber;

        return $resultVMList;
    }


    /**
     * @param $id
     * @return EventVM | \DomainException
     */
    public function actionView( int $id )
    {
        if( !$id ){
            return new \DomainException('Id must be integer');
        }
        $one = $this->repo->get( $id );

        if( !$one ){
            return new \DomainException('Item Not Found!');
        }

        $oneVM = new EventVM();
        $oneVM->Id = $one->Id;
        $oneVM->Title = $one->Title;
        $oneVM->StartDate = $one->StartDate;
        $oneVM->ShortDescription = $one->ShortDescription;
        $oneVM->FullDescription = $one->FullDescription;
        $oneVM->EventCategoryId = $one->EventCategoryId;
        $oneVM->LanguageId = $one->LanguageId;
        $oneVM->SpeakerFullName = $one->SpeakerFullName;

        // Dictionary
        $oneVM->EventCategory = $one->eventCategory;
        $oneVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');
        return $oneVM;
    }
}
