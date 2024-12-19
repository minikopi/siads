<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\RoleStore;
use App\Http\Requests\Administrator\RoleUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laratrust\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-section.role.index');
    }

    public function data()
    {
        $data = Role::all();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('admin-section.role.button', compact('data'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
        return view('admin-section.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStore $request)
    {
        abort(404);
        try {
            DB::beginTransaction();

            Role::create($request->validated());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::warning($th->getMessage(), [
                'action' => 'store role',
                'user' => $request->user(),
                'data' => $request->validated(),
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }
        return to_route('administrator.roles.index')->with('success', 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->edit($role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin-section.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdate $request, Role $role)
    {
        try {
            DB::beginTransaction();

            $role->update($request->validated());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::warning($th->getMessage(), [
                'action' => 'update role',
                'user' => $request->user(),
                'data' => $request->validated(),
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }
        return to_route('administrator.roles.index')->with('success', 'Berhasil mengubah data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->edit($role);
    }
}
