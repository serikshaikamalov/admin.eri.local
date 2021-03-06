<?php

namespace common\entities;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\AsyaAvrupa;

/**
 * AsyaAvrupaSearch represents the model behind the search form of `common\entities\AsyaAvrupa`.
 */
class AsyaAvrupaSearch extends AsyaAvrupa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'LanguageId', 'StatusId'], 'integer'],
            [['Title', 'TitleSecond', 'InteractiveSrc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = AsyaAvrupa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'LanguageId' => $this->LanguageId,
            'StatusId' => $this->StatusId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'TitleSecond', $this->TitleSecond])
            ->andFilterWhere(['like', 'InteractiveSrc', $this->InteractiveSrc]);

        # Order
        $query->orderBy(['CreatedDate' => SORT_DESC]);

        return $dataProvider;
    }
}
