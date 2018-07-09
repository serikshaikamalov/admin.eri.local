<?php
namespace api\controllers;
use api\viewmodels\PublicationListVM;
use api\viewmodels\PublicationVM;
use api\viewmodels\ResearchFellowListVM;
use api\viewmodels\ResearchFellowVM;
use api\viewmodels\StaffListVM;
use api\viewmodels\StaffVM;
use api\viewmodels\VisitingResearchFellowListVM;
use common\repositories\PublicationCategoryRepository;
use common\repositories\PublicationRepository;
use common\repositories\PublicationMainTagRepository;
use common\repositories\ResearchFellowRepository;
use common\repositories\StaffRepository;
use dpodium\filemanager\components\FilemanagerHelper;
use phpDocumentor\Reflection\Types\Nullable;
use Yii;
use yii\helpers\ArrayHelper;

class ResearchFellowController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    # REPOSITORIES
    public $repo;

    public function  __construct(string $id,
                                 $module,
                                 ResearchFellowRepository $repo,
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
     * @param int $researchFellowTypeId
     * @param int $languageId
     * @param int $pageNumber
     * @param int $researchFellowCategoryId
     * @param int $limit
     *
     * @return ResearchFellowListVM
     */
    public function actionIndex( int $languageId = 1,
                                 int $researchFellowTypeId = 1,
                                 int $researchFellowCategoryId = 1,
                                 int $pageNumber = 1,
                                 int $limit = 3
                                ): ResearchFellowListVM
    {
        $vm = new ResearchFellowListVM();

        # FILTER: Pagination
        $this->pageNumber = $pageNumber;
        $this->limit = $limit;
        $this->offset = $this->limit * ($this->pageNumber - 1);



        # TOTAL COUNT
        $vm->TotalCount = $this->repo->count( $languageId,
                                              $researchFellowTypeId,
                                              $researchFellowCategoryId );


        # DATA
        $all = $this->repo->getAll( $languageId,
                                    $researchFellowTypeId,
                                    $researchFellowCategoryId,
                                    $this->offset,
                                    $this->limit );

        # VIEW MODEL
        if( count($all) > 0 ){
            foreach ($all as $one){

                $oneVM = new ResearchFellowVM();
                $oneVM->Id = $one->Id;
                $oneVM->Title = $one->Title;
                $oneVM->ShortDescription = $one->ShortDescription;
                $oneVM->FullDescription = $one->FullDescription;
                $oneVM->CreatedDate =  date('d.m.Y', strtotime($one->CreatedDate) );
                $oneVM->ResearchFellowTypeId = $one->ResearchFellowTypeId;
                $oneVM->ResearchFellowCategoryId = $one->ResearchFellowCategoryId;


                # Dictionaries
                $oneVM->ImageSource = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');

                $vm->Items[] = $oneVM;
            }

            $vm->PageNumber = $this->pageNumber;
        }

        return $vm;
    }


    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function actionView( int $id )
    {
        $one = $this->repo->get($id);

        $oneVM = new ResearchFellowVM();

        if( $one ){
            $oneVM->Id = $one->Id;

            $oneVM->Title = $one->Title;
            $oneVM->ShortDescription = $one->ShortDescription;
            $oneVM->FullDescription = $one->FullDescription;
            $oneVM->CreatedDate = date('d.m.Y', strtotime($one->CreatedDate) );
            $oneVM->ImageSource = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');

            # DICTIONARIES
            $oneVM->ResearchFellowType = $one->researchFellowType ? $one->researchFellowType : null;
            $oneVM->ResearchFellowCategory = $one->researchFellowCategory ? $one->researchFellowCategory : null;

            # FILE: PDF
            if( $one->FilePDFId ){
                $file = FilemanagerHelper::getFile($one->FilePDFId, "file_identifier");
                $oneVM->FilePDFSource = FILE_SERVER . $file['img_src'];
            }

            # FILE: WORD
            if( $one->FileWordId ){
                $file = FilemanagerHelper::getFile($one->FileWordId, "file_identifier");
                $oneVM->FileWordSource = FILE_SERVER . $file['img_src'];
            }

        }
        return $oneVM;
    }

}
