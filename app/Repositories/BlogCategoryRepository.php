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
        //return $this->startConditions()->all();

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        /*$result[] = $this->startConditions()->all();
        $result[] = $this
            ->startConditions()
            ->select('blog_categories.*',
                \DB::raw('CONCAT (id, ". ", title) AS id_title'))
            ->toBase()
            ->get();*/

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;

    }


    /**
     * Получить категории для пагинации
     *
     * @param $perPage
     * @return mixed
     */
    public function getAllWithPaginate($perPage)
    {
        $columns = ['id', 'title', 'parent_id'];


        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

}