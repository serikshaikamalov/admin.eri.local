<?php
namespace common\entities;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EventsSearch
 */
class EventsSearch extends Event
{
    public function rules()
    {
        return [
            [
                [
                    'Id',
                    'EventCategoryId',
                    'LanguageId',
                    'CreatedBy',
                    'StatusId'
                ],
                'integer'
            ],
            [
                [
                    'Title',
                    'StartDate',
                    'ShortDescription',
                    'FullDescription',
                    'SpeakerFullName',
                    'CreatedDate'
                ],
                'safe'
            ],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = Event::find()
            ->with('language')
            ->with('status')
            ->with('eventCategory')
            ->with('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'StartDate' => $this->StartDate,
            'EventCategoryId' => $this->EventCategoryId,
            'LanguageId' => $this->LanguageId,
            'CreatedBy' => $this->CreatedBy,
            'CreatedDate' => $this->CreatedDate,
            'StatusId' => $this->StatusId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'SpeakerFullName', $this->SpeakerFullName]);
        return $dataProvider;
    }
}
