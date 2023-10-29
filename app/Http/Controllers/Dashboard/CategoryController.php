<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use app\Http\Requests\Dashboard\category\CategoryDeleteRequest;
use App\Http\Requests\Dashboard\category\CategoryStoreRequest;

use App\Http\Requests\Dashboard\category\CategoryUpdateRequest;
use App\Services\CategoryServices;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $categoryServices;
    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices=$categoryServices;
    }

    public function index()
    {
       // $mainCategories=Category::where('parent_id',0)->orwhere('parent_id',null)->get();
           $mainCategories=$this->categoryServices->getmaincategory();
       return view('dashboard.categories.index',compact('mainCategories'));
    }

    public function getall()
    {

          return $this->categoryServices->datatable();
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
         $this->categoryServices->store($request->validated());
        return redirect()->route('dashboard.categories.index')->with('success', 'تمت الاضافة بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category=$this->categoryServices->getbyId($id);


       $mainCategories=$this->categoryServices->getmaincategory();
       return view('dashboard.categories.edit',compact('category','mainCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request,  $id)
    {
          $this->categoryServices->update($id,$request->validated());
          return redirect()->route('dashboard.categories.index')->with('تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete(Request $request){
      //Category::whereId($request->id)->delete();
      //return redirect()->route('dashboard.categories.index');
        $this->categoryServices->delete($request->all());
        return redirect()->route('dashboard.categories.index');
    }
}
