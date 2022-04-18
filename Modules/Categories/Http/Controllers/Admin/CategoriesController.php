<?php

namespace Modules\Categories\Http\Controllers\Admin;

use Modules\Categories\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;
use Modules\Categories\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class CategoriesController extends BaseController
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Categories', 'List of all categories');

        return view('categories::admin.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = $this->categoryRepository->treeList();

        $this->setPageTitle('Categories','Create category');

        return view('categories::admin.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->createCategory($request->except('_token'));

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }

        return $this->responseRedirect('admin.categories.index', 'Category added successfully','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $currentCategory = $this->categoryRepository->findCategoryById($id);

        $categories = $this->categoryRepository->treeList($currentCategory->id);

        $this->setPageTitle('Categories', 'Edit Category : '.$currentCategory->name);

        return view('categories::admin.edit', compact('currentCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        $update =  $this->categoryRepository->updateCategory($request->except('_token'), $id);

        if (!$update) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category updated successfully' ,'success',false, false);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $deleted = $this->categoryRepository->deleteCategory($id);
        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category deleted successfully' ,'success',false, false);

    }
}
