<?php
namespace common\entities;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class EventCategorySearch extends EventCategory
{
    public function rules()
    {
        return [
            [['Id', 'StatusId', 'ParentId', 'LanguageId'], 'integer'],
            [['Title'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EventCategory::find()
                    ->with('language')
                    ->with('status');

        // add conditions that should always apply here

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
            'StatusId' => $this->StatusId,
            'ParentId' => $this->ParentId,
            'LanguageId' => $this->LanguageId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title]);

        return $dataProvider;
    }
}
