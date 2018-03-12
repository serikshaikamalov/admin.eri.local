<?php
namespace common\repositories;
use common\entities\Staff;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class StaffRepository
{
//    public $pageNumber;
//    public $limit;
//    public $offset;
//    public $totalCount;
//
//    public function __construct( $pageNumber, $limit, $offset, $totalCount )
//    {
//        $this->pageNumber = 1;
//        $this->limit = 10;
//        $this->offset = $this->limit * ($this->pageNumber - 1);
//    }

    /*
     * @return Event
     */
    public function get($Id): Staff {

        $staff = Staff::find()
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('researchGroup')
            ->where([
                'StatusId' => Staff::STATUS_PUBLISHED,
                'Id' => $Id
            ])
            ->one();

        if(!$staff){
            throw new \DomainException('Id not found!');
        }
        return $staff;
    }


    /*
     * @return Event count
     */
    public function count(int $languageId): int{
        return Staff::find()
            ->where([
                'StatusId' => Staff::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->count();
    }


    /*
     * @return Event[]
     */
    public function getAll( int $languageId, int $offset, int $limit ): array
    {
        return Staff::find()
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('researchGroup')
            ->where([
                'StatusId' => Staff::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->offset($offset)
            ->limit($limit)
            ->all();
    }


    /*
     * @return Latest Events
     */
    public function getLatest(): array
    {
        return Staff::find()
            ->with('user')
            ->orderBy(['Id' => SORT_DESC])->all();
    }


    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }


}