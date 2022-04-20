<?php

namespace Modules\Categories\Http\Controllers\Frontend;

use Modules\Categories\Contracts\CategoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function show($slug)
    {
        $category = $this->categoryRepository->findBySlug($slug);

        return view('frontend.pages.category', compact('category'));
    }
}
