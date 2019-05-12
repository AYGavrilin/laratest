<?php


namespace App\Repositories;


use App\Models\BlogCategory as Model;

class BlogPostRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}