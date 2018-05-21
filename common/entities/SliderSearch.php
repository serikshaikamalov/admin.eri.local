<?php
namespace common\entities;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\Slider;

class SliderSearch extends Slider
{
    public function rules()
    {
        return [
            [
                [
                    'Id',
                    'ImageId'
                ], 'integer'],
            [
                [
                    'Title',
                    'Url',
                    'IsActive',
                    'Description'
                ], 'safe'],
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

    public function search($params)
    {
        $query = Slider::find();

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
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'Url', $this->Url])
            ->andFilterWhere(['like', 'IsActive', $this->IsActive])
            ->andFilterWhere(['like', 'Description', $this->Description]);

        return $dataProvider;
    }
}
