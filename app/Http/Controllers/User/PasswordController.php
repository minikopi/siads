<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user-section.password.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PasswordStoreRequest $request)
    {
        $user = $request->user();

        DB::beginTransaction();
        try {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->password);
            } else {
                return redirect()->back()->withInput();
            }

            $user->save();

            DB::commit();
            return back()->with('success', 'Berhasil ubah kata sandi.');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::warning($th->getMessage(), [
                'action' => 'update password',
                'user_id' => $request->user()->id,
            ]);
            return back()->with('error', 'Terjadi Kesalahan! ' . $th->getMessage());
        }

    }
}
