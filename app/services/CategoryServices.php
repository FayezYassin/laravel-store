<?php
namespace App\Services;
//use App\Repositorties\CategoryRepository;
use App\Models\Category;
use App\Repositorties\CategoryRepository;
use App\Utils\ImageUpload;
use DataTables;

 class CategoryServices{

  public $categoryrepository;

    public function __construct(CategoryRepository $repository)
    {
        $this->categoryrepository=$repository;
    }

    public function getAll()
    {
        return $this->categoryrepository->baseQuery(['child'])->get();
    }

    public function getmaincategory(){
        return  $this->categoryrepository->getMainCategories();
    }

    public function store($params){
        if(isset($params['image'])){
            $params['image']=ImageUpload::uploadImage($params['image']);
        }
        return  $this->categoryrepository->store($params);
    }

    public function datatable(){

        $query = $this->categoryrepository->baseQuery(['parent']);
        return  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return $btn = '
                        <a href="' . Route('dashboard.categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>

                        <button type="button" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-danger mt-md-0 mt-2" data-bs-toggle="modal"
                        data-original-title="test" data-bs-target="#deletemodal"><i class="fa fa-trash"></i></button>';
            })

            ->addColumn('parent', function ($row) {
                if ($row->parent) {
                    return $row->parent->name;
                }
                return 'قسم رئيسي';
            })

            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" width="100px" height="100px">';
            })

            ->rawColumns(['parent', 'action', 'image'])
            ->make(true);


    }


    public function getbyId($id, $childrenCount = false)
    {
        $query =  Category::where('id', $id);
        if ($childrenCount) {
            $query->withCount('child');
        }
        return $query->firstOrFail();
    }

        public function update($id,$params){
            $category=$this->getbyId($id);
            $params['parent_id']=$parent['parent_id']??0;
        if(isset($params['image'])){
        $params['image']=ImageUpload::uploadImage($params['image']);
        }
        return $category->update($params);

        }

        public function delete($params)
        {
            $this->categoryrepository->delete($params);
        }

}
