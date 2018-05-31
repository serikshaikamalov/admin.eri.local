<?php
namespace common\entities;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\Gallery;

class GallerySearch extends Gallery
{
    public function rules()
    {
        return [
            [['Id', 'Hits', 'StatusId', 'LanguageId', 'CreatedUserId'], 'integer'],
            [['Title', 'Description', 'LastEditedDate'], 'safe'],
        ];
    }

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
        $query = Gallery::find();

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
            'Hits' => $this->Hits,
            'StatusId' => $this->StatusId,
            'LanguageId' => $this->LanguageId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'Description', $this->Description]);

        $query->orderBy([ 'Id' => SORT_DESC]);

        return $dataProvider;
    }
}
