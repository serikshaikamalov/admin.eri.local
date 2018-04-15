<?php
namespace api\controllers;
use api\viewmodels\PublicationListVM;
use api\viewmodels\PublicationVM;
use api\viewmodels\StaffListVM;
use api\viewmodels\StaffVM;
use common\repositories\PublicationCategoryRepository;
use common\repositories\PublicationRepository;
use common\repositories\PublicationMainTagRepository;
use common\repositories\StaffRepository;
use phpDocumentor\Reflection\Types\Nullable;
use Yii;
use yii\helpers\ArrayHelper;

class PublicationsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    // REPOSITORIES
    public $repo;
    public $repoPublicationCategory;
    public $repoResearchGroup;

    public function  __construct(string $id,
                                 $module,
                                 PublicationRepository $repo,
                                 PublicationCategoryRepository $repoPublicationCategory,
                                 PublicationMainTagRepository $researchGroupRepository,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->repoPublicationCategory = $repoPublicationCategory;
        $this->repoResearchGroup = $researchGroupRepository;
        $this->pageNumber = 1;
        $this->limit = 10;
        $this->offset = 10;
    }

    /**
     * @param int $publicationTypeId
     * @param int $languageId
     * @param int $pageNumber
     * @param int $publicationCategoryId
     * @param int $staffId
     * @param int $limit
     * @param string $orderBy
     * @param int $publicationMainTagId
     * @param string $date - Format: 2018-02-01
     *
     * @return PublicationListVM
     */
    public function actionIndex(
                                 int $publicationTypeId = 1,
                                 int $languageId = 1,
                                 int $pageNumber = 1,
                                 int $publicationCategoryId = 0,
                                 int $staffId = 0,
                                 int $limit = 10,
                                 string $orderBy = 'Id',
                                 int $publicationMainTagId = 0,
                                 string $date = ""
                                ): PublicationListVM
    {
        $this->pageNumber = $pageNumber;
        $this->limit = $limit;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        $publicationVMList = new PublicationListVM();
        $publicationVMList->PageNumber = $this->pageNumber;


        // Get publication categories
        $ChildCategoryIds = [];
        if( $publicationCategoryId != 0 ){
            $ChildCategoryIds = $this->repoPublicationCategory->getChildren($publicationCategoryId);
            $ChildCategoryIds = ArrayHelper::getColumn($ChildCategoryIds, 'Id');
            $ChildCategoryIds[] = $publicationCategoryId;
        }

        // Get publication main tags
        $childMainTagIds = [];
        if( $publicationMainTagId != 0 ){
            $childMainTagIds = $this->repoResearchGroup->getChildren($publicationMainTagId);
            $childMainTagIds = ArrayHelper::getColumn($childMainTagIds, 'Id');
            $childMainTagIds[] = $publicationMainTagId;
        }

        $publicationVMList->TotalCount = $this->repo->count( $languageId,
                                                             $publicationTypeId,
                                                             $ChildCategoryIds,
                                                             $staffId,
                                                             $childMainTagIds,
                                                             $date
                                                            );


        // GET PUBLICATIONS FROM DB
        $publications = $this->repo->getAll( $publicationTypeId,
                                             $languageId,
                                             $this->offset,
                                             $this->limit,
                                             $ChildCategoryIds,
                                             $staffId,
                                             $orderBy,
                                             $childMainTagIds,
                                             $date
                                            );

        if( count($publications) > 0 ){
            foreach ($publications as $publication){

                $publicationVM = new PublicationVM();
                $publicationVM->Id = $publication->Id;
                $publicationVM->Title = $publication->Title;
                $publicationVM->ShortDescription = $publication->ShortDescription;
                $publicationVM->FullDescription = $publication->Description;
                $publicationVM->ImageId = $publication->ImageId;
                $publicationVM->StaffId = $publication->StaffId;
                $publicationVM->LanguageId = $publication->LanguageId;
                $publicationVM->StatusId = $publication->StatusId;
                $publicationVM->CreatedDate =  date('d.m.Y', strtotime($publication->CreatedDate) );
                $publicationVM->PublicationCategoryId = $publication->PublicationCategoryId;
                $publicationVM->Hits = $publication->Hits;
                $publicationVM->PublicationMainTagId = $publication->PublicationMainTagId;

                // Dictionaries
                $publicationVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($publication->ImageId, 400, 400,'inset');;
                $publicationVM->Staff = $publication->staff ? $publication->staff : null;
                $publicationVM->Language = $publication->language ? $publication->language : null;
                $publicationVM->Status = $publication->status ? $publication->status : null;
                $publicationVM->PublicationCategory = $publication->publicationCategory ? $publication->publicationCategory : null;
                $publicationVM->PublicationMainTag = $publication->publicationMainTag ? $publication->publicationMainTag : null;
                $publicationVMList->PublicationList[] = $publicationVM;
            }
        }

        return $publicationVMList;
    }


    /*
     * @returns:  List of staffs
     */
    public function actionView( int $id )
    {
        $publication = $this->repo->get($id);
        $publicationVM = new PublicationVM();

        if( $publication ){
            $publicationVM->Id = $publication->Id;
            $publicationVM->Title = $publication->Title;
            $publicationVM->ShortDescription = $publication->ShortDescription;
            $publicationVM->FullDescription = $publication->Description;
            $publicationVM->ImageId = $publication->ImageId;
            $publicationVM->StaffId = $publication->StaffId;
            $publicationVM->LanguageId = $publication->LanguageId;
            $publicationVM->StatusId = $publication->StatusId;
            $publicationVM->CreatedDate = date('d.m.Y', strtotime($publication->CreatedDate) );
            $publicationVM->Hits = $publication->Hits;
            $publicationVM->PublicationMainTagId = $publication->PublicationMainTagId;


            // Dictionaries
            $publicationVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($publication->ImageId, 400, 400,'inset');
            $publicationVM->Staff = $publication->staff ? $publication->staff : null;
            $publicationVM->Language = $publication->language ? $publication->language : null;
            $publicationVM->Status = $publication->status ? $publication->status : null;
            $publicationVM->PublicationMainTag = $publication->publicationMainTag ? $publication->publicationMainTag : null;
            $publicationVM->PublicationCategory = $publication->publicationCategory ? $publication->publicationCategory : null;


            // Update Hits
            $this->repo->updateHits($publication->Id);
        }
        return $publicationVM;
    }

}
