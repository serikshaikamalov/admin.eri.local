<?php
namespace common\entities;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['Id', 'UserId'], 'integer'],
            [['Title', 'Description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = Article::find();

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
            'UserId' => $this->UserId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'Description', $this->Description]);

        return $dataProvider;
    }
}
