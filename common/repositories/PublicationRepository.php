<?php
namespace common\repositories;
use common\entities\Publication;
use common\entities\Status;

class PublicationRepository
{
    /*
     * @return Publication
     */
    public function get($Id): Publication {

        $entity = Publication::find()
            ->with('language')
            ->with('status')
            ->with('publicationCategory')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'Id' => $Id
            ])
            ->one();

        if(!$entity){
            throw new \DomainException('Id not found!');
        }
        return $entity;
    }


    /*
     * @return Publication's Count
     */
    public function count(): int{
        return Publication::find()->count();
    }


    /*
     * @return latest Publications[]
     */
    public function getAll( int $languageId, int $offset, int $limit ): array
    {
        return Publication::find()
            ->with('language')
            ->with('status')
            ->with('publicationCategory')
            ->with('staff')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->offset($offset)
            ->limit($limit)
            ->orderBy(['Id' => SORT_DESC])
            ->all();
    }
}