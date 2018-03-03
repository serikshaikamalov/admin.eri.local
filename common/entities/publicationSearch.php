<?php

namespace common\entities;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\publication;

/**
 * publicationSearch represents the model behind the search form of `common\entities\publication`.
 */
class publicationSearch extends publication
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'PublicationCategoryId', 'StaffId', 'CreatedDate', 'CreatedBy', 'ViewsCount', 'StatusId', 'LanguageId', 'FileId'], 'integer'],
            [['Title', 'IsFeatured', 'ImageId', 'Description', 'ShortDescription'], 'safe'],
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
        $query = publication::find();

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
            'PublicationCategoryId' => $this->PublicationCategoryId,
            'StaffId' => $this->StaffId,
            'CreatedDate' => $this->CreatedDate,
            'CreatedBy' => $this->CreatedBy,
            'ViewsCount' => $this->ViewsCount,
            'StatusId' => $this->StatusId,
            'LanguageId' => $this->LanguageId,
            'FileId' => $this->FileId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'IsFeatured', $this->IsFeatured])
            ->andFilterWhere(['like', 'ImageId', $this->ImageId])
            ->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'ShortDescription', $this->ShortDescription]);

        return $dataProvider;
    }
}
