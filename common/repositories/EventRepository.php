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
     * @param string $searchQuery
     *
     * @return int Publication's total count
     */
    public function count( int $languageId,
                           int $eventTypeId = 1,
                           array $eventCategoryIds = [],
                           string $searchQuery = ''): int{
        $query =  Event::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
            ]);


        # FILTER: Query
        $query->andWhere([
            'like','Title', $searchQuery
        ]);


        # FILTER: Type
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


        # FILTER: Category
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
     * @param string $searchQuery
     *
     * @return array Publications[]
     */
    public function getAll( int $languageId,
                            int $eventTypeId = 1,
                            array $eventCategoryIds = [],
                            int $offset,
                            int $limit,
                            string $orderBy = 'Id',
                            string $searchQuery = ''
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


            # FILTER: Query
            $query->andWhere([
                'like','Title', $searchQuery
            ]);

            # FILTER: Event Type
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

            # FILTER: Category
            if( count($eventCategoryIds) > 0 ){
                $query->andWhere([
                    'EventCategoryId' => $eventCategoryIds
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
        $one = Event::findOne( $newsId );
        if( $one ){
            $one->Hits = ($one->Hits > 0) ? $one->Hits + 1 : 1;
            $IsSaved = $one->save();
        }
        return $IsSaved;
    }
}