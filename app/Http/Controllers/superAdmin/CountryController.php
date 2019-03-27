<?php

namespace App\Http\Controllers\superAdmin;

use App\Repository\GradesRepository;
use App\Repository\CountryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countrys=CountryRepository::all();
        return view('superadmin.country.index', compact('countrys','grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|unique:country|max:191',
            'value' => 'required|unique:country|max:191',
        ],
            [
                'name.required' => 'من فضلك ادخل  ادخل اسم البلد ',
                'name.max' => 'اسم الدوله لا يجب ان يزيد عن 191 حرف ',
                'value.max' => 'قيمة البلد لا يجب ان تزيد عن 191 حرف',
                'value.required' => 'من فضلك ادخل قيمه البلد  ',
                'value.unique' => 'تكرار القيمه ممنوع  ',]);
        $countrys=$request->except('_token');
        CountryRepository::save($countrys);
        return redirect(url('country'))->with('success', 'تمتالإضافة بنجاح ');
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countrys=CountryRepository::find($id);
        return view('superadmin.country.edit',compact('countrys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|unique:country,name,' . $id . 'max:191',
            'value' => 'required|unique:country,value,' . $id . '|max:191',
        ],
            [
                'name.required' => 'من فضلك ادخل  ادخل اسم البلد ',
                'name.max' => 'اسم الدوله لا يجب ان يزيد عن 191 حرف ',
                'value.max' => 'قيمة البلد لا يجب ان تزيد عن 191 حرف',
                'value.required' => 'من فضلك ادخل قيمه البلد  ',
                'value.unique' => 'تكرار القيمه ممنوع  ',]);
        $countrys=$request->except('_token');
        CountryRepository::update($id,$countrys);
        return redirect(url('country'))->with('success', 'تم التعديل بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CountryRepository::delete($id);
        return redirect(url('country'))->with('success', 'تم الحذف بنجاح ');
    }
}
