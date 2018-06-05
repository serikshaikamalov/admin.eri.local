<?php
namespace api\controllers;

use common\entities\ImageToGallery;
use common\repositories\GalleryRepository;
use api\viewmodels\GalleryViewModel;
use api\viewmodels\GalleryListVM;
use dpodium\filemanager\components\FilemanagerHelper;


class GalleryController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 GalleryRepository $repo,
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
     * @param $languageId
     * @param $pageNumber
     * @return mixed
     * @throws \Exception
     */
    public function actionIndex( int $languageId = 1,
                                 int $pageNumber = 1)
    {
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        # REPO
        $this->totalCount = $this->repo->count( $languageId);


        $VMList = new \stdClass();
        $VMList->page = $this->pageNumber;
        $VMList->totalCount = $this->totalCount;

        # REPO
        $galleryEntities = $this->repo->getAll( $languageId,
            $this->offset,
            $this->limit);

        if( count($galleryEntities) > 0 ){
            foreach ($galleryEntities as $galleryEntity){
                $oneVM = new GalleryViewModel();

                $oneVM->Id = $galleryEntity->Id;
                $oneVM->Title = $galleryEntity->Title;
                $oneVM->Description = $galleryEntity->Description;
                $oneVM->Hits = $galleryEntity->Hits;
                $oneVM->StatusId = $galleryEntity->StatusId;
                $oneVM->LanguageId = $galleryEntity->LanguageId;
                $oneVM->CreatedDate = $galleryEntity->CreatedDate;


                ### Get images

                # Get Gallery's images
                $galleryImage = ImageToGallery::find()
                    ->where(['GalleryId' => $galleryEntity->Id])
                    ->one();

                if( $galleryImage ){
                    if( $galleryImage->ImageId ){
                        $imageSource = FilemanagerHelper::getFile($galleryImage->ImageId, "file_identifier");
                        $oneVM->image = FILE_SERVER . $imageSource['img_src'];
                    }


                }


                $VMList->items[] = $oneVM;

            }
        }

        return $VMList;
    }


    /**
     * @param int $languageId
     * @param int $pageNumber
     * @return GalleryListVM
     * @throws \Exception
     */
    public function actionGetLatestGalleryToHomePage( int $languageId = 1,
                                 int $pageNumber = 1)
    {
        $this->pageNumber = $pageNumber;
        $this->limit = 4;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        # REPO
        $this->totalCount = $this->repo->count( $languageId);


        $VMList = new GalleryListVM();
        $VMList->page = $this->pageNumber;
        $VMList->totalCount = $this->totalCount;

        # REPO
        $galleryEntities = $this->repo->getAll( $languageId,
            $this->offset,
            $this->limit);

        if( count($galleryEntities) > 0 ){
            foreach ($galleryEntities as $galleryEntity){
                $oneVM = new \stdClass();

                $oneVM->Id = $galleryEntity->Id;
                $oneVM->Title = $galleryEntity->Title;
                $oneVM->Description = $galleryEntity->Description;
                $oneVM->Hits = $galleryEntity->Hits;
                $oneVM->StatusId = $galleryEntity->StatusId;
                $oneVM->LanguageId = $galleryEntity->LanguageId;
                $oneVM->CreatedDate = $galleryEntity->CreatedDate;


                ### Get images

                # Get Gallery's images
                $galleryImage = ImageToGallery::find()
                    ->where(['GalleryId' => $galleryEntity->Id])
                    ->one();

                if( $galleryImage ){

                    if( $galleryImage->ImageId ){
                        $imageSource = FilemanagerHelper::getFile($galleryImage->ImageId, "file_identifier");
                        $oneVM->image = FILE_SERVER . $imageSource['img_src'];
                     }
                }

                $VMList->items[] = $oneVM;
            }
        }

        return $VMList;
    }


    /*
     * @returns:  List of staffs
     */
    public function actionView( int $id )
    {
        $galleryEntity = $this->repo->get($id);

        $oneVM = new GalleryViewModel();

        if( $galleryEntity ){
            $oneVM->Id = $galleryEntity->Id;
            $oneVM->Title = $galleryEntity->Title;
            $oneVM->Description = $galleryEntity->Description;
            $oneVM->Hits = $galleryEntity->Hits;
            $oneVM->StatusId = $galleryEntity->StatusId;
            $oneVM->LanguageId = $galleryEntity->LanguageId;
            $oneVM->CreatedDate = $galleryEntity->CreatedDate;


            ### Get images

            # Get Gallery's images
            $galleryImages = ImageToGallery::find()
                    ->where(['GalleryId' => $galleryEntity->Id])
                    ->all();

            if( $galleryImages ){
                foreach ($galleryImages as $image){
                    if( $image->ImageId ){
                        $imageSource = FilemanagerHelper::getFile($image->ImageId, "file_identifier");
                        $oneVM->images[] = FILE_SERVER . $imageSource['img_src'];
                    }

                }
            }

        }
        return $oneVM;
    }

}
