<?php

namespace Modules\Categories\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Categories\Entities\Category;
use Modules\Core\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Modules\Categories\Contracts\CategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class CategoryRepository extends BaseRepository implements CategoryContract
{
    use UploadAble;

    /**
     * @return Category
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    protected function model(): string
    {
        return Category::class;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCategories(string $order = 'name', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->model->query()
            ->select($columns)
            ->Parent()
            ->orderBy($order, $sort)->get();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCategoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createCategory(array $params)
    {
        try {
            $collection = collect($params);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'categories');
            }

            $featured = $collection->has('featured') ? 1 : 0;
            $menu = $collection->has('menu') ? 1 : 0;

            $merge = $collection->merge(compact('image', 'featured', 'menu'));

            $category = new Category($merge->all());

            $category->save();

            return $category;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }


    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory(array $params,int $id)
    {
        $category = $this->findCategoryById($id);

        $collection = collect($params);

        $image = null;

        if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {

            if ($category->image != null) {
                $this->deleteOne($category->image);
            }

            $image = $this->uploadOne($params['image'], 'categories');
        }

        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;

        $merge = $collection->merge(compact('image', 'featured', 'menu'));

        $category->update($merge->all());

        return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCategory($id)
    {
        $category = $this->findCategoryById($id);

        if ($category->image != null) {
            $this->deleteOne($category->image);
        }
        $category->delete();

        return $category;
    }
    /**
     * @return mixed
     */
    public function treeList($id = null)
    {
        return Category::orderByRaw('-name ASC')
            ->get()
            ->except($id)
            ->nest()
            ->setIndent('> ')
            ->listsFlattened('name');
    }

    public function findBySlug($slug)
    {
        return Category::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
