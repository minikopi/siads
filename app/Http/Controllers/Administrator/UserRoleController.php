<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laratrust\Models\Role;
use Yajra\DataTables\DataTables;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-section.user-role.index');
    }

    public function data()
    {
        $data = User::with('roles')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('admin-section.user-role.button', compact('data'));
            })
            ->addColumn('role', function ($data) {
                return $data->roles()->pluck('display_name');
            })
            ->rawColumns(['action', 'role'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user_role)
    {
        $this->edit($user_role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user_role)
    {
        $roles = Role::all();

        return view('admin-section.user-role.edit', compact('roles'), ['user' => $user_role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user_role)
    {
        try {
            DB::beginTransaction();

            $user_role->roles()->sync($request->roles);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::warning($th->getMessage(), [
                'action' => 'store user role',
                'user' => $request->user(),
                'data' => $request->validated(),
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }
        return to_route('administrator.user-role.index')->with('success', 'Berhasil mengubah user role.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user_role)
    {
        abort(404);
    }
}
