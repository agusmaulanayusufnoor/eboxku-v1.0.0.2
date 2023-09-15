<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Users\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;



class UserController extends BaseController
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
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        //$users = User::all();
        $users = DB::table('users')
                ->join('kode_kantors', 'users.kantor_id', '=', 'kode_kantors.id')
                ->select('users.id','users.type','users.name','users.username',
                'users.kantor_id','kode_kantors.nama_kantor','users.otorisator')->get();
                // ->paginate(10);

       // dd($users);
        return $this->sendResponse($users, 'Users list');
        //return datatables($users)->toJson();;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        // $user = User::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        //     'type' => $request['type'],
        // ]);

        $user = User::create([
            'name'      => $request['name'],
            'username'  => $request['username'],
            'password'  => Hash::make($request['password']),
            'type'      => $request['type'],
            'kantor_id' => $request['kantor_id'],
            'otorisator' => $request['otorisator'],
        ]);
        return $this->sendResponse($user, 'User Ditambahkan');
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        //dd($request->all());
        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());

        return $this->sendResponse($user, 'Data User Diubah!');
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

        $user = User::findOrFail($id);
        // delete the user

        $user->delete();

        return $this->sendResponse([$user], 'User sudah dihapus!');
    }
}
