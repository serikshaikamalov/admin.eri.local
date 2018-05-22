<?php
namespace common\repositories;
use common\entities\Event;
use common\entities\Status;

class EventRepository
{
    /**
     * @param int $Id
     *
     * @return Event
     */
    public function get($Id): Event {

        $entity = Event::find()
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
     * @param int $eventTypeId
     * @param array $eventCategoryIds
     * @return int Publication's total count
     */
    public function count( int $languageId,
                           int $eventTypeId = 1,
                           array $eventCategoryIds = [] ): int{
        $query =  Event::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
            ]);


        /**
         * FILTER
         */
        $dateTime = new \DateTime('now');
        $dateTimeString = $dateTime->format('Y-m-d H:i');

        switch ( $eventTypeId ){
            case Event::UPCOMING_EVENT :
                $query->andWhere(['>', 'StartDate', $dateTimeString ]);
                break;
            case Event::PAST_EVENT :
                $query->andWhere(['<', 'StartDate', $dateTimeString ]);
                break;
        }


        // Event Category
        if( count($eventCategoryIds) > 0 ){
            $query->andWhere([
                'EventCategoryId' => $eventCategoryIds
            ]);
        }

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $eventTypeId
     * @param array $eventCategoryIds
     * @param int $offset
     * @param int $limit
     * @param string $orderBy
     *
     * @return array Publications[]
     */
    public function getAll( int $languageId,
                            int $eventTypeId = 1,
                            array $eventCategoryIds = [],
                            int $offset,
                            int $limit,
                            string $orderBy = 'Id'
                          ): array
    {
        $query = Event::find()
            ->with('language')
            ->with('status')
            ->with('eventCategory')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => [$languageId, 0],
            ]  )
            ->offset($offset)
            ->limit($limit);

            /**
             *  Neutral Language
             */
            #$query->andWhere(['LanguageId' => 0]);


            /**
             * FILTER
             */

            // Event Type
            /**
             * DateTime object
             */
            $dateTime = new \DateTime('now');
            $dateTimeString = $dateTime->format('Y-m-d H:i');

            switch ( $eventTypeId ){
                case Event::UPCOMING_EVENT :
                    $query->andWhere(['>', 'StartDate', $dateTimeString ]);
                    break;
                case Event::PAST_EVENT :
                    $query->andWhere(['<', 'StartDate', $dateTimeString ]);
                    break;
            }

            // Event Category
            if( count($eventCategoryIds) > 0 ){
                $query->andWhere([
                    'EventCategoryId' => $eventCategoryIds
                ]);
            }


            /**
             * SORTING
             */
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
     * @param int $newsId
     *
     * @return bool
     */
    public function updateHits( int $newsId)
    {
        $IsSaved = false;
        $one = Event::findOne( $newsId );
        if( $one ){
            $one->Hits = ($one->Hits > 0) ? $one->Hits + 1 : 1;
            $IsSaved = $one->save();
        }
        return $IsSaved;
    }
}