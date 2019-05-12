<?php


namespace App\Repositories;


use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }


    /**
     * Получить данные для редактирования
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


    /**
     * Получить список категорий для выпадающего списка
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getForComboBox()
    {
        return $this->startConditions()->all();
    }

}