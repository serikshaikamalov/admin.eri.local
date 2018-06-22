<?php
namespace common\repositories;
use common\entities\EriInPress;
use common\entities\Status;

class EriInPressRepository
{
    /**
     * @param int $languageId
     * @param string $searchQuery
     *
     * @return int Publication's total count
     */
    public function count(
                        int $languageId,
                        $searchQuery = '' ): int{

        $query =  EriInPress::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
            ]);

        # Filter: Query
        $query->andWhere([
            'like','Title', $searchQuery
        ]);

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @param string $orderBy
     * @param string $searchQuery
     *
     * @return array Publications[]
     */
    public function getAll( int $languageId,
                            int $offset,
                            int $limit,
                            string $orderBy = 'CreatedDate',
                            string $searchQuery = ''
                          ): array
    {
        $query = EriInPress::find()
            ->with('language')
            ->with('status')
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

            # SORT
            switch( $orderBy ){
                default:
                case 'CreatedDate':
                    $query->orderBy(['CreatedDate' => SORT_DESC]);
                    break;
            }
            return $query->all();
    }

}