<?php
namespace common\repositories;
use common\entities\Staff;
use common\entities\Status;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class StaffRepository
{
    /**
     * @param int $Id
     * @return Staff | null
     */
    public function get($Id): Staff {

        $staff = Staff::find()
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('publicationMainTag')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'Id' => $Id
            ])
            ->one();

        if(!$staff){
            throw new \DomainException('Id not found!');
        }
        return $staff;
    }


    /**
     * @param int $languageId
<<<<<<< HEAD
     * @param int $staffTypeId
     * @return int
     */
    public function count(int $languageId,
                          int $staffTypeId = 0): int{

=======
     * @param int $publicationMainTagId
     *
     * @return int Staff[] - count
     */
    public function count(int $languageId, int $publicationMainTagId = 0): int{
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004
        $query = Staff::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  );

<<<<<<< HEAD
        // FILTER BY: StaffTypeId
        if( $staffTypeId != 0 ){
            $query->andWhere([
                'StaffTypeId' => $staffTypeId
            ]);
        }

            return $query->count();
=======

        // Filter
        if( $publicationMainTagId != 0 ){
            $query->andWhere([
                'PublicationMainTagId' => $publicationMainTagId
            ]);
        }

        return $query->count();
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
<<<<<<< HEAD
     * @param int $staffTypeId
     * @return array
     */
    public function getAll( int $languageId = 1,
                            int $offset,
                            int $limit = 10,
                            int $staffTypeId = 0): array
    {
        $query = Staff::find()
=======
     * @param int $publicationMainTagId
     *
     * @return array
     */
    public function getAll( int $languageId,
                            int $offset,
                            int $limit,
                            int $publicationMainTagId = 0 ): array
    {
         $query = Staff::find()
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('publicationMainTag')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->offset($offset)
            ->limit($limit);


<<<<<<< HEAD
        // FILTER BY: StaffTypeId
        if( $staffTypeId != 0 ){
            $query->andWhere([
                'StaffTypeId' => $staffTypeId
            ]);
        }

        return $query->all();
=======
         if( $publicationMainTagId != 0 ){
            $query->andWhere([
                'PublicationMainTagId' => $publicationMainTagId
            ]);
        }


         return $query->all();
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004
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