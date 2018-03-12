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
            ->with('staff')
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
    public function count( int $languageId, int $publicationCategoryId = 0 ): int{
        $query =  Publication::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]);

        if( $publicationCategoryId != 0 ){
            $query->andWhere([
                'PublicationCategoryId' => $publicationCategoryId
            ]);
        }

        return $query->count();
    }


    /*
     * @return latest Publications[]
     */
    public function getAll( int $languageId, int $offset, int $limit, int $publicationCategoryId = 0 ): array
    {
        $query = Publication::find()
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
            ->orderBy(['Id' => SORT_DESC]);

            if( $publicationCategoryId != 0 ){
                $query->andWhere([
                    'PublicationCategoryId' => $publicationCategoryId
                ]);
            }


            return $query->all();
    }
}