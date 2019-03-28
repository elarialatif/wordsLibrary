<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Categery;
use App\Models\ListCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Session;
use  Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware("Permissions:categories");//permissions middleware
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $main_categories = Categery::with('children')->whereNull('parent_id')->get();

        $categories_all = Categery::with('children')->get();

        $categories = DB::table('categories')->where('parent_id', NULL)->get();
        $sub_categories = [];
        $sub_sub_categories = [];
        foreach ($categories as $category) {
            $sub_categories[$category->id] = DB::table('categories')->where('parent_id', $category->id)->get();
            foreach ($sub_categories[$category->id] as $sub_category) {
                $sub_sub_categories[$sub_category->id] = DB::table('categories')->where('parent_id', $sub_category->id)->get();
            }
        }
//        print_r($categories);
//        print_r($sub_categories);
        $object = (object)$sub_categories;//        echo gettype($sub_categories);
        ;


//        print_r($sub_sub_categories);
        return view('superadmin.categories.index', compact('main_categories'))->with('categories', $categories)->with('sub_categories', $sub_categories)->with('sub_sub_categories', $sub_sub_categories)->with(compact('categories_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_all = Categery::all();

        $categories = DB::table('categories')->where('parent_id', NULL)->get();
        $sub_categories = [];
        $sub_sub_categories = [];
        foreach ($categories as $category) {
            $sub_categories[$category->id] = DB::table('categories')->where('parent_id', $category->id)->get();
            foreach ($sub_categories[$category->id] as $sub_category) {
                $sub_sub_categories[$sub_category->id] = DB::table('categories')->where('parent_id', $sub_category->id)->get();
            }
        }
        return view('superadmin.categories.create')->with('categories_all', $categories_all)->with('categories', $categories)->with('sub_categories', $sub_categories)->with('sub_sub_categories', $sub_sub_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'name' => 'required|unique:categories,name,null,null,parent_id,' . Input::get('parent_id') . '|max:191',


        ],
            [
                'name.required' => 'من فضلك ادخل  ادخل اسم التصنيف ',
                'name.unique' => 'الاسم موجود بالفعل ',
                'name.max' => 'الاسم يجب الا يزيد عن 191 حرف ',
            ]);


        if ($this->checkCatNameDuplicationConstraint($request->name, $request->parent_id)) {
            Session::flash('alert', 'هذا التصنيف موجود بالفعل ');
            return redirect('categories');
        }

        $categories = new Categery;
        $categories->name = Input::get('name');
        if (Input::get('parent_id')) {
            $categories->parent_id = Input::get('parent_id');
        }

        $categories->save();
//        $arr['name'] = $categories->name;
//        $arr['table_name'] = 'التصنيفات';
//        $arr['type'] = 'إضافة';
//        $arr['row_id'] = $categories->id;
//        LogTimeController::saveLogesTimes($arr);
        // redirect
        Session::flash('message', 'لقد تم إدخال التصنيف بنجاح');
        return redirect('categories');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_selected = Categery::find($id);

        $categories = Categery::with('children')->whereNull('parent_id')->get();

        // show the edit form and pass the nerd
        return view('superadmin.categories.edit')->with('categories_all', $categories)->with('category_selected', $category_selected);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        request()->validate([
            'name' => 'required|unique:categories,name,null,null,parent_id,' . Input::get('parent_id') . 'max:191',


        ],
            [
                'name.required' => 'من فضلك ادخل  ادخل اسم التصنيف ',
                'name.unique' => 'الاسم موجود بالفعل ',
                'name.max' => 'الاسم يجب الا يزيد عن 191 حرف ',
            ]);

        if ($this->checkCatNameDuplicationConstraint($request->name, $request->parent_id)) {
            Session::flash('alert', 'هذا التصنيف موجود بالفعل ');
            return redirect('categories');
        }
        $categories = Categery::find($id);
        $categories->name = Input::get('name');
        if (Input::get('parent_id')) {
            $categories->parent_id = Input::get('parent_id');
        }
        if (Input::get('parent_id') == "main") {
            $categories->parent_id = null;
        }

        $this->checkCatNameDuplicationConstraint($request->name, $request->parent_id, $id);


        $categories->save();
//        $arr['name'] = $categories->name;
//        $arr['table_name'] = 'التصنيفات';
//        $arr['type'] = 'تعديل';
//        $arr['row_id'] = $categories->id;
//        LogTimeController::saveLogesTimes($arr);
        // redirect
        Session::put('success', 'لقد تم تعديل التصنيف بنجاح');
        return Redirect::to('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $isAllowedToBeDeleted = false;
        $deleteErrMsg = "";

        $catgerory = Categery::find($id);


        $category_children = Categery::where("parent_id", $id)->get();
        if ($category_children->count() > 0) {
            $isAllowedToBeDeleted = true;
            $deleteErrMsg = "لايمكنك المسح .. التصنيف لديه تصنيفات داخليه";
        }

        if ($this->checkIfCatgHasContent($id)) {
            $isAllowedToBeDeleted = true;
            $deleteErrMsg = "لايمكنك المسح .. التصنيف لديه موضوعات دراسيه";
        }

        if ($isAllowedToBeDeleted) {
            Session::put('error', $deleteErrMsg);
            return Redirect::to('categories');
        } else {
//            $arr['name'] = $catgerory->name;
//            $arr['table_name'] = 'التصنيفات';
//            $arr['type'] = 'مسح';
//            $arr['row_id'] = $catgerory->id;
            $catgerory->delete();


//            LogTimeController::saveLogesTimes($arr);
            Session::put('success', 'لقد تم حذف التصنيف بنجاح');
            return Redirect::to('categories');

        }
    }


    private function checkCatNameDuplicationConstraint($catName, $parentID, $id = false)
    {


        $row = Categery::where(['name' => $catName, 'parent_id' => $parentID]);
        if ($id) { //in case update , don't get the current row as duplication
            $row->where("id", "!=", $id);
        }
        $result = $row->get();

        if ($result->count() > 0) {
            return true;
        }

        return false;

    }

    private function checkIfCatgHasContent($cat_id)
    {

        $contents = ListCategory::where('cat_id', $cat_id)->get();
        if ($contents->count() > 0) {

            return true;
        }
        return false;

    }
}
