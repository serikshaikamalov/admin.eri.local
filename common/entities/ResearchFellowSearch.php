<?php
namespace common\entities;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\ResearchFellow;

class ResearchFellowSearch extends ResearchFellow
{
    public function rules()
    {
        return [
            [['Id', 'researchFellowType', 'researchFellowCategoryId', 'ImageId', 'FilePDFId', 'FileWordId', 'CreatedBy'], 'integer'],
            [['Title', 'ShortDescription', 'FullDescription', 'CreatedDate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ResearchFellow::find();

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
            'researchFellowType' => $this->researchFellowType,
            'researchFellowCategoryId' => $this->researchFellowCategoryId,
            'ImageId' => $this->ImageId,
            'FilePDFId' => $this->FilePDFId,
            'FileWordId' => $this->FileWordId,
            'CreatedBy' => $this->CreatedBy,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'ShortDescription', $this->ShortDescription])
            ->andFilterWhere(['like', 'FullDescription', $this->FullDescription])
            ->andFilterWhere(['like', 'CreatedDate', $this->CreatedDate]);

        return $dataProvider;
    }
}
