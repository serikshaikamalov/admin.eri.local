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
            ->with('publicationTag')
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
     * @param string $date
     * @param string $searchQuery
     *
     * @return int Publication[] length
     */
    public function count( int $languageId,
                           int $publicationTypeId = 1,
                           array $publicationCategoryIds = [],
                           int $staffId = 0,
                           array $mainTagIds = [],
                           string $date = "",
                           string $searchQuery = ""
                         ): int{

        $query =  Publication::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
                'PublicationTypeId' => $publicationTypeId
            ]);

        # FILTER: Category
        if( count($publicationCategoryIds) > 0 ){
            $query->andWhere([
                'PublicationCategoryId' => $publicationCategoryIds
            ]);
        }

        # FILTER: Tags
        if( count($mainTagIds) > 0 ){
            $query->andWhere([
                'PublicationMainTagId' => $mainTagIds
            ]);
        }

        # FILTER: Staffs
        if( $staffId != 0 ){
            $query->andWhere([
                'StaffId' => $staffId
            ]);
        }

        # FILTER: Date
        if( $date && $date != "" && $date != null ){

            $dateTime = new \DateTime(date('Y-m-d', strtotime($date)));

            $year = $dateTime->format('Y');
            $month = $dateTime->format('m');
            $startDay = 1;
            $endDay = $dateTime->format('t');

            $startDate =  "{$year}-{$month}-{$startDay}";
            $endDate =  "{$year}-{$month}-{$endDay}";

            $query->andWhere([
                'between','CreatedDate',$startDate, $endDate
            ]);
        }

        # FILTER: Query
        $query->andWhere([
            'like','Title', $searchQuery
        ]);

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
     * @param string $date
     * @param string $searchQuery
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
                            array $mainTagIds = [],
                            string $date = "",
                            string $searchQuery = ""
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

            # FILTER: Query
            $query->andWhere([
                'like','Title', $searchQuery
            ]);

            # FILTER: Category
            if( count($publicationCategoryIds) > 0 ){
                $query->andWhere([
                    'PublicationCategoryId' => $publicationCategoryIds
                ]);
            }

            # FILTER: Type
            if( $publicationTypeId ){
                $query->andWhere([
                    'PublicationTypeId' => $publicationTypeId
                ]);
            }

            # FILTER: Staff
            if( $staffId != 0 ){
                $query->andWhere([
                    'StaffId' => $staffId
                ]);
            }

            # FILTER: Main Tag
            if( count($mainTagIds) > 0 ){
                $query->andWhere([
                    'PublicationMainTagId' => $mainTagIds
                ]);
            }

            # FILTER: Date
            if( $date && $date != "" && $date != null ){

                 $dateTime = new \DateTime(date('Y-m-d', strtotime($date)));

                $year = $dateTime->format('Y');
                $month = $dateTime->format('m');
                $startDay = 1;
                $endDay = $dateTime->format('t');

                $startDate =  "{$year}-{$month}-{$startDay}";
                $endDate =  "{$year}-{$month}-{$endDay}";

                $query->andWhere([
                    'between','CreatedDate',$startDate, $endDate
                ]);
            }

            # SORT
            switch( $orderBy ){
                default:
                case 'Id':
                    $query->orderBy(['Id' => SORT_DESC]);
                    break;
                case 'Hits':
                    $query->orderBy(['Hits' => SORT_DESC]);
                    break;
                case 'CreatedDate':
                    $query->orderBy(['CreatedDate' => SORT_DESC]);
            }


            return $query->all();
    }


    /**
     * Publication: Search by query
     *
     * @param string $searchQuery
     * @param int $publicationTypeId
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     *
     * @return array Publications[]
     */
    public function getAllByQuery(
                            string $searchQuery = '',
                            int $publicationTypeId = 1,
                            int $languageId,
                            int $offset,
                            int $limit
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

        # QUERY
        $query->andWhere([
            'like','Title', $searchQuery
        ]);


        # FILTER:
        if( $publicationTypeId ){
            $query->andWhere([
                'PublicationTypeId' => $publicationTypeId
            ]);
        }

        # ORDER BY
        $query->orderBy(['CreatedDate' => SORT_DESC]);

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