<?php
namespace common\repositories;
use common\entities\Publication;
use common\entities\Status;

class PublicationRepository
{
    /**
     * @param int $Id - Publication Id
     *
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


    /**
     * @param int $languageId
     * @param int $publicationTypeId
     * @param array $publicationCategoryIds
     * @param int $staffId
     * @param array $mainTagIds
     *
     * @return int Publication[] length
     */
    public function count( int $languageId,
                           int $publicationTypeId = 1,
                           array $publicationCategoryIds = [],
                           int $staffId = 0,
                           array $mainTagIds = []
                         ): int{
        $query =  Publication::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
                'PublicationTypeId' => $publicationTypeId
            ]);

        // Filter
        if( count($publicationCategoryIds) > 0 ){
            $query->andWhere([
                'PublicationCategoryId' => $publicationCategoryIds
            ]);
        }

        // Filter By Publication MainTagIds
        if( count($mainTagIds) > 0 ){
            $query->andWhere([
                'PublicationMainTagId' => $mainTagIds
            ]);
        }

        if( $staffId != 0 ){
            $query->andWhere([
                'StaffId' => $staffId
            ]);
        }

        return $query->count();
    }


    /**
     * @param int $publicationTypeId
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @param array $publicationCategoryIds[]
     * @param int $staffId
     * @param string $orderBy
     * @param array $mainTagIds
     *
     * @return array Publications[]
     */
    public function getAll( int $publicationTypeId = 1,
                            int $languageId,
                            int $offset,
                            int $limit,
                            array $publicationCategoryIds = [],
                            int $staffId = 0,
                            string $orderBy = 'Id',
                            array $mainTagIds = []
                          ): array
    {
        $query = Publication::find()
            ->with('language')
            ->with('status')
            ->with('publicationCategory')
            ->with('publicationMainTag')
            ->with('staff')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
            ]  )
            ->offset($offset)
            ->limit($limit);

            // Filter By Publication CategoryIds
            if( count($publicationCategoryIds) > 0 ){
                $query->andWhere([
                    'PublicationCategoryId' => $publicationCategoryIds
                ]);
            }

            // Filter By Publication TypeId
            if( $publicationTypeId ){
                $query->andWhere([
                    'PublicationTypeId' => $publicationTypeId
                ]);
            }

            // Filter By Publication StaffId
            if( $staffId != 0 ){
                $query->andWhere([
                    'StaffId' => $staffId
                ]);
            }

            // Filter By Publication MainTagIds
            if( count($mainTagIds) > 0 ){
                $query->andWhere([
                    'PublicationMainTagId' => $mainTagIds
                ]);
            }

            // ORDER BY
            switch( $orderBy ){
                default:
                case 'Id':
                    $query->orderBy(['Id' => SORT_DESC]);
                    break;
                case 'Hits':
                    $query->orderBy(['Hits' => SORT_DESC]);
                    break;
            }

            //var_dump($query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql); die();

            return $query->all();
    }


    /**
     * Update Publication's Hits
     * @param int $publicationId
     *
     * @return bool
     */
    public function updateHits( int $publicationId)
    {
        $IsSaved = false;
        $one = Publication::findOne( $publicationId );
        if( $one ){
            $one->Hits = ($one->Hits > 0) ? $one->Hits + 1 : 1;
            $IsSaved = $one->save();
        }
        return $IsSaved;
    }

}