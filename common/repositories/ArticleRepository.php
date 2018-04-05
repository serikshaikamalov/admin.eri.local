<?php
namespace common\repositories;
use common\entities\Article;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class ArticleRepository
{
    public function get($Id): Article{

        if(!$post = Article::findOne($Id)){
            return 'Item not found! ';
        }
        return $post;
    }

    /**
     * Find Article by its url
     *
     * @param int $languageId
     * @param string $link
     *
     * @return Article
     */
    public function getByUrl( int $languageId, string $link ): Article{

        $article = Article::find()
            ->where([
                'LanguageId' => $languageId,
                'Link' => $link
            ])
            ->one();

        return $article;
    }


    public function count(): int{
        return Article::find()->count();
    }


    public function getAll(): DataProviderInterface
    {
        $query = Article::find();
        return $this->getProvider($query);
    }

    public function getLatest(): array
    {
        return Article::find()
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