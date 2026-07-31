<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();

        return $this->sendResponse($roles, 'List Daftar Role User');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'description' => 'required|string|max:100',
        ]);

        $role = Role::create([
            'name' => strtolower(trim($request['name'])),
            'description' => $request['description'],
        ]);

        return $this->sendResponse($role, 'Role User Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return $this->sendResponse($role, 'Detail Role User');
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
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $id,
            'description' => 'required|string|max:100',
        ]);

        $role->update([
            'name' => strtolower(trim($request['name'])),
            'description' => $request['description'],
        ]);

        return $this->sendResponse($role, 'Data Role User Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $role = Role::findOrFail($id);
        $role->delete();

        return $this->sendResponse([$role], 'Role User sudah dihapus!');
    }
}
