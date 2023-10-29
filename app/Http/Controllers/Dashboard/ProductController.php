<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\StoreProductRequest;


use App\Repositorties\CategoryRepository;
use App\Repositorties\ProductRepository;
use App\Services\CategoryServices;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public CategoryServices $categoryService;
    public ProductService $productService;

    public function __construct(CategoryServices $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index()
    {
        //dd('fayez yassin ');
        return view('dashboard.products.index');
    }

    public function alldata (){

    }

    /*public function getall(Request $request)
    {
        dd('fayez yasaas');
       $this->productService->datatable();
    }*/


    public function create()
    {

        $categories = $this->categoryService->getAll();
        return view('dashboard.products.create' , compact('categories'));
    }


    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->store($request->validated());
        return redirect()->route('dashboard.products.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = $this->categoryService->getAll();
        $product = $this->productService->getById($id);
       return view('dashboard.products.edit' , compact('categories', 'product'));
    }


    public function update(Request $request, $id)
    {
       $this->productService->update($id,$request->all());
       return redirect()->route('dashboard.products.index');
    }


    public function destroy($id)
    {
        //
    }
}
