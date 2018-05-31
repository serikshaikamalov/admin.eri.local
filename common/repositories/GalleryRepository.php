<?php
namespace common\repositories;
use common\entities\Gallery;
use common\entities\ImageToGallery;
use common\entities\Staff;
use common\entities\Status;
use common\viewmodels\GalleryViewModel;

class GalleryRepository
{
    /**
     * @param int $Id
     * @return mixed
     */
    public function get($Id) {
        $one = Gallery::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'Id' => $Id
            ])
            ->one();

        if(!$one){
            throw new \DomainException('Id not found!');
        }
        return $one;
    }


    /**
     * @param int $languageId
     * @return int
     */
    public function count(int $languageId): int{

        $query = Gallery::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  );


        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getAll( int $languageId = 1,
                            int $offset,
                            int $limit = 10): array
    {
        $query = Gallery::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->orderBy(['Id' => SORT_DESC])
            ->offset($offset)
            ->limit($limit);

        return $query->all();
    }

}