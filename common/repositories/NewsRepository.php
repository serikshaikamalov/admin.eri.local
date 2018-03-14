<?php
namespace common\repositories;
use common\entities\News;
use common\entities\Publication;
use common\entities\Status;

class NewsRepository
{
    /**
     * @param int $Id
     *
     * @return News
     */
    public function get($Id): News {

        $entity = News::find()
            ->with('language')
            ->with('status')
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
     *
     * @return int Publication's total count
     */
    public function count( int $languageId): int{
        $query =  News::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
            ]);

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @param string $orderBy
     *
     * @return array Publications[]
     */
    public function getAll( int $languageId,
                            int $offset,
                            int $limit,
                            string $orderBy = 'Id'
                          ): array
    {
        $query = News::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
            ]  )
            ->offset($offset)
            ->limit($limit);


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
            return $query->all();
    }


    /**
     * @param int $newsId
     *
     * @return bool
     */
    public function updateHits( int $newsId)
    {
        $IsSaved = false;
        $one = News::findOne( $newsId );
        if( $one ){
            $one->Hits = ($one->Hits > 0) ? $one->Hits + 1 : 1;
            $IsSaved = $one->save();
        }
        return $IsSaved;
    }

}