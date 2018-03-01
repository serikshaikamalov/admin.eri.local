<?php
namespace common\repositories;
use common\entities\Post;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class PostRepository
{
    public function get($Id): Post{

        if(!$post = Post::findOne($Id)){
            return \DomainException('Item not found! ');
        }
        return $post;
    }


    public function count(): int{
        return Post::find()->count();
    }


    public function getAll(): DataProviderInterface
    {
        $query = Post::find();
        return $this->getProvider($query);
    }


    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }

    public function getLatest(): array
    {
        return Post::find()
            ->with('user')
            ->orderBy(['Id' => SORT_DESC])->all();
    }





}