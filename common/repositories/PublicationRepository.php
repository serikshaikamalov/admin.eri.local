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
     * @param int $publicationCategoryId
     * @param int $staffId
     *
     * @return int Publication's total count
     */
    public function count( int $languageId,
                           int $publicationTypeId = 1,
                           int $publicationCategoryId = 0,
                           int $staffId = 0
                         ): int{
        $query =  Publication::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
                'PublicationTypeId' => $publicationTypeId
            ]);

        if( $publicationCategoryId != 0 ){
            $query->andWhere([
                'PublicationCategoryId' => $publicationCategoryId
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
     *
     * @return array Publications[]
     */
    public function getAll( int $publicationTypeId = 1,
                            int $languageId,
                            int $offset,
                            int $limit,
                            array $publicationCategoryIds = [],
                            int $staffId = 0,
                            string $orderBy = 'Id'
                          ): array
    {
        $query = Publication::find()
            ->with('language')
            ->with('status')
            ->with('publicationCategory')
            ->with('staff')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
            ]  )
            ->offset($offset)
            ->limit($limit);

            if( count($publicationCategoryIds) > 0 ){
                $query->andWhere([
                    'PublicationCategoryId' => $publicationCategoryIds
                ]);
            }

            if( $publicationTypeId ){
                $query->andWhere([
                    'PublicationTypeId' => $publicationTypeId
                ]);
            }

            if( $staffId != 0 ){
                $query->andWhere([
                    'StaffId' => $staffId
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