<?php
namespace common\repositories;
use common\entities\Staff;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class StaffRepository
{

    /*
     * @return Event
     */
    public function get($Id): Staff{

        if(!$event = Staff::findOne($Id)){
            throw new \DomainException('Id not found!');
        }
        return $event;
    }


    /*
     * @return Event count
     */
    public function count(): int{
        return Staff::find()->count();
    }


    /*
     * @return Event[]
     */
    public function getAll(): DataProviderInterface
    {
        $query = Staff::find();
        return $this->getProvider($query);
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