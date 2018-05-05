<?php
namespace common\entities;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\publication;

class publicationSearch extends publication
{
    public function rules()
    {
        return [
            [
                [
                    'Id',
                    'PublicationCategoryId',
                    'StaffId',
                    'CreatedDate',
                    'CreatedBy',
                    'Hits',
                    'StatusId',
                    'LanguageId',
                    'FileId'
                ], 'integer'
            ],
            [
                [
                    'Title',
                    'IsFeatured',
                    'ImageId',
                    'Description',
                    'ShortDescription'
                ], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = publication::find()->where(['LanguageId' => \Yii::$app->language] );
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
            'PublicationCategoryId' => $this->PublicationCategoryId,
            'StaffId' => $this->StaffId,
            'CreatedDate' => $this->CreatedDate,
            'CreatedBy' => $this->CreatedBy,
            'Hits' => $this->Hits,
            'StatusId' => $this->StatusId,
            'LanguageId' => $this->LanguageId,
            'FileId' => $this->FileId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'IsFeatured', $this->IsFeatured])
            ->andFilterWhere(['like', 'ImageId', $this->ImageId])
            ->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'ShortDescription', $this->ShortDescription]);

        $query->orderBy(['Id' => SORT_DESC]);

        return $dataProvider;
    }
}
