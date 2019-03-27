<?php

namespace App\Http\Controllers;

use App\Repository\GradesRepository;
use App\Repository\LevelsRepository;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = GradesRepository::all();
        return view('listsmaker.grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = LevelsRepository::all();
        return view('listsmaker.grades.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:grades|max:255',
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'الاسم مكرر'
        ]);
        $grades = $request->except('_token');
        GradesRepository::save($grades);
        return redirect(url('levels'))->with('success', 'تمت الإضافة بنجاح ');
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
        $levels = LevelsRepository::all();
        $grades = GradesRepository::find($id);
        return view('listsmaker.grades.edit', compact('grades', 'levels'));
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
        $grades = $request->except('_token');
        GradesRepository::update($id, $grades);
        return redirect()->back()->with('success', 'تم التعديل بنجاح ');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = GradesRepository::delete($id);

        if ($delete == false) {
            return redirect()->back()->withErrors('توجد موضوعات لهذا الصف ');
        }
        return redirect()->back()->with('success', 'تم الحذف بنجاح ');
    }
}
