<?php

namespace common\repositories;
use common\entities\Post;

class PostRepository{

    public function get($Id): Post{

        if(!$post = Post::findOne($Id)){
            return \DomainException('Item not found! ');
        }


        return $post;


    }


}