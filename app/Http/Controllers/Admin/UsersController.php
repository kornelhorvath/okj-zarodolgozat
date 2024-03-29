<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::sortable()->get();
        return view('admin.users.index', compact('users'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $data = request()->validate([
            'vezeteknev'=>'required|max:15',
            'keresztnev'=>'required|max:15',
            'email'=>'required|max:50',
            'telefonszam'=>'sometimes|max:15',
            'iranyitoszam'=>'sometimes|max:4',
            'telepules'=>'sometimes|max:30',
            'utca'=>'sometimes|max:20',
            'hazszam'=>'sometimes|max:5',
            'egyeb'=>'sometimes|max:20',
        ]);

        $user->update($data);

        return redirect()->route('admin.users.index');
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $column = $request->get('column');
        $type = $request->get('type');

        if($type == 'reszleges')
            $users = User::where($column, 'LIKE', '%' . $search . '%')->get();
        else if($type == 'teljes')
            $users = User::where($column, $search)->get();

        return view('admin.users.index', compact('users'));
    }
}
