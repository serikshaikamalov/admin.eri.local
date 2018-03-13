<?php
namespace api\controllers;
use api\viewmodels\PublicationListVM;
use api\viewmodels\PublicationVM;
use api\viewmodels\StaffListVM;
use api\viewmodels\StaffVM;
use common\repositories\PublicationCategoryRepository;
use common\repositories\PublicationRepository;
use common\repositories\StaffRepository;
use phpDocumentor\Reflection\Types\Nullable;
use Yii;
use yii\helpers\ArrayHelper;

class PublicationsController extends ApiBaseController
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
                                 PublicationRepository $repo,
                                 PublicationCategoryRepository $repoPublicationCategory,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->repoPublicationCategory = $repoPublicationCategory;
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
     *
     * @return PublicationListVM
     */
    public function actionIndex(
                                 int $publicationTypeId = 1,
                                 int $languageId = 1,
                                 int $pageNumber = 1,
                                 int $publicationCategoryId = 0,
                                 int $staffId = 0
                                ): PublicationListVM
    {
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        $publicationVMList = new PublicationListVM();
        $publicationVMList->PageNumber = $this->pageNumber;
        $publicationVMList->TotalCount = $this->repo->count( $languageId,
                                                             $publicationTypeId,
                                                             $publicationCategoryId,
                                                             $staffId
                                                            );

        // Get publication categories
        $ChildCategoryIds = [];
        if( $publicationCategoryId != 0 ){
            $ChildCategoryIds = $this->repoPublicationCategory->getChildren($publicationCategoryId);
            $ChildCategoryIds = ArrayHelper::getColumn($ChildCategoryIds, 'Id');
            $ChildCategoryIds[] = $publicationCategoryId;
        }

        $publications = $this->repo->getAll( $publicationTypeId,
                                             $languageId,
                                             $this->offset,
                                             $this->limit,
                                             $ChildCategoryIds,
                                             $staffId
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
                $publicationVM->CreatedDate = $publication->CreatedDate;
                $publicationVM->PublicationCategoryId = $publication->PublicationCategoryId;

                // Dictionaries
                $publicationVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($publication->ImageId, 400, 400,'inset');;
                $publicationVM->Staff = $publication->staff ? $publication->staff : null;
                $publicationVM->Language = $publication->language ? $publication->language : null;
                $publicationVM->Status = $publication->status ? $publication->status : null;
                $publicationVM->PublicationCategory = $publication->publicationCategory ? $publication->publicationCategory : null;
                //$publicationVM->ResearchGroup = $publication->researchGroup ? $publication->researchGroup : null;
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
            $publicationVM->CreatedDate = $publication->CreatedDate;

            // Dictionaries
            $publicationVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($publication->ImageId, 400, 400,'inset');;
            $publicationVM->Staff = $publication->staff ? $publication->staff : null;
            $publicationVM->Language = $publication->language ? $publication->language : null;
            $publicationVM->Status = $publication->status ? $publication->status : null;
            //$publicationVM->ResearchGroup = $publication->researchGroup ? $publication->researchGroup : null;
            $publicationVM->PublicationCategory = $publication->publicationCategory ? $publication->publicationCategory : null;
        }
        return $publicationVM;
    }

}
