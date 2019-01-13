<?php

namespace App\Http\Controllers\superAdmin;

use App\Repository\ContentListsRepository;
use App\Repository\CountryRepository;
use App\Repository\TaskRepository;
use App\Repository\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=UsersRepository::all();
        return view('superadmin.users.index', compact('users'));
    }

   public function profile(){
        $user=UsersRepository::find(auth()->id());
        $tasks=TaskRepository::findAllWhere('user_id',$user->id);
        return view('auth.profile',compact('user','tasks'));
   }

   public function updateProfile(Request $request, $id){
       $users=$request->except('_token');
       UsersRepository::profile($id,$users);
       return redirect(url('profile'))->with('success', 'تم التعديل بنجاح ');
   }

    public function edit($id)
    {
        $users=UsersRepository::find($id);
        return view('listsmaker.users.edit',compact('users'));
    }


    public function filter($grade_id,$date){
        $user=UsersRepository::find(auth()->id());
        $data['grade_id']=$grade_id;
        $data['date']=$date;
        $tasks=TaskRepository::filter($data);
        return view('auth.profile',compact('user','tasks'));
    }
    public function update(Request $request, $id)
    {
        $users=$request->except('_token');

//        if($request->input('password') && $request->input('password') !=null ){
//            $users=$request->except('_token','password');
//        }
//        dd($users);
        UsersRepository::update($id,$users);
        return redirect(url('users'))->with('success', 'تم التعديل بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UsersRepository::delete($id);
        return redirect(url('users'))->with('success', 'تم الحذف بنجاح ');
    }
}

