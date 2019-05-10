<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.create', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

//        $item = new BlogCategory($data);
//        $item->save();
        $item = (new BlogCategory())->create($data);

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Запись успешно добавлена']);
        } else {
            return back()->withErrors(['msg' => 'Произошла ошибка при сохранении'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        //$validateData = $this->validate($request, $rules); //валидация через контроллер

        /*$validator = \Validator::make($request->all(), $rules);
        $validateData[] = $validator->passes(); // проверяет и возвращает тру или фолс
        //$validateData[] = $validator->validate();
        $validateData[] = $validator->valid();
        $validateData[] = $validator->failed();
        $validateData[] = $validator->errors();
        $validateData[] = $validator->fails();

        dd($validateData);*/

        $item = BlogCategory::find($id);
        if (empty($item)) {
            return back()                                                   // Переход обратно, если итем пришел пустой
                ->withErrors(['msg' => "Запись с id = [{$id}] не найдена"]) // Записываем ошибки в сессию
                ->withInput();                                              // Возвращаем введенные пользователем данные
        }

        $data = $request->all(); // Закидываем в дату все, что есть в реквесте
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $result = $item->fill($data)->save(); // Перезаписываем в итеме методом fill данные, которые пришли с запросом, сохраняем. Возвращается true или false

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id) //Маршрут редиректа с идентификатором
                ->with(['success' => 'Успешно сохранено']); // Через сессию отправляем инфо об успешной записи
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
}
