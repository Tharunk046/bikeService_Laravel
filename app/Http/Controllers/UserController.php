<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = DB::table('users')->where('usertype',0)->simplePaginate(5);
        return view('admin.users')->with('users',$users);
    }

    /**
     * Show the form for creating a new users.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified user details.
     */
    public function show(string $id)
    {
        //
        $profile = DB::table('users')->where('id',$id)->get();
        return view('profile')->with('userdetail',$profile);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $profile = User::find($id);
        return view('edit_profile')->with('profile',$profile);
    }

    /**
     * Update the specified resource in user.
     */
    public function update(Request $request, $id)
    {
        $profile = User::find($id);
        $profile->name = $request->get('name');
        $profile->email = $request->get('email');  
        $profile->phone = $request->get('phone');    
        $profile->save();
        return redirect('profile/'.$id)->with(array('message'=> 'Profile updated successfully !!', 'color'=>'alert-success'));
    }

    /**
     * Remove the specified resource from users.
     */
    public function destroy($id)
    {
        $detail = User::find($id);
        $name = $detail->name;
        User::destroy($id);
        return redirect('admin/users/')->with(array('message'=> $name.' Deleted successfully !!', 'color'=>'alert-danger'));
    }
}
