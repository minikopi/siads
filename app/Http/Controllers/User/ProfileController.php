<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DosenProfileUpdateRequest;
use App\Http\Requests\User\MahasantriProfileUpdateRequest;
use App\Http\Requests\User\UserProfileUpdateRequest;
use App\Models\Dosen;
use App\Models\Mahasantri;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());

        $data = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        $data = array_merge($data, $this->dosen($user->getKey()), $this->mahasantri($user->getKey()));

        return view('user-section.profile.index', compact('data'));
    }

    private function mahasantri($id): array
    {
        $data = Mahasantri::firstWhere('user_id', $id);

        $result = [
            'mahasantri' => false
        ];

        if ($data) {
            $result = [
                'mahasantri' => true,
                'nim' => $data->nim ?? null,
                'nama_depan' => $data->nama_depan ?? null,
                'nama_belakang' => $data->nama_belakang ?? null,
                'nama_lengkap' => $data->nama_lengkap ?? null,
                'handphone' => $data->handphone ?? null,
                'nik' => $data->nik ?? null,
                'alamat' => $data->alamat ?? null,
                'kode_pos' => $data->kode_pos ?? null,
                'tanggal_lahir' => $data->tanggal_lahir ?? null,
                'tempat_lahir' => $data->tempat_lahir ?? null,
                'suku' => $data->suku ?? null,
                'saudara' => $data->saudara ?? null,
                'anak_ke' => $data->anak_ke ?? null,
                'whatsapp' => $data->whatsapp ?? null,
                'foto' => $data->foto ?? null,
                'nama_ayah' => $data->nama_ayah ?? null,
                'tempat_ayah' => $data->tempat_ayah ?? null,
                'lahir_ayah' => $data->lahir_ayah ?? null,
                'pendidikan_ayah' => $data->pendidikan_ayah ?? null,
                'pekerjaan_ayah' => $data->pekerjaan_ayah ?? null,
                'penghasilan_ayah' => $data->penghasilan_ayah ?? null,
                'nama_ibu' => $data->nama_ibu ?? null,
                'tempat_ibu' => $data->tempat_ibu ?? null,
                'lahir_ibu' => $data->lahir_ibu ?? null,
                'pendidikan_ibu' => $data->pendidikan_ibu ?? null,
                'pekerjaan_ibu' => $data->pekerjaan_ibu ?? null,
                'penghasilan_ibu' => $data->penghasilan_ibu ?? null,
                'nama_wali' => $data->nama_wali ?? null,
                'alamat_wali' => $data->alamat_wali ?? null,
                'handphone_wali' => $data->handphone_wali ?? null,
                'whatsapp_wali' => $data->whatsapp_wali ?? null,
                'asal_sekolah' => $data->asal_sekolah ?? null,
                'nomor_ijazah' => $data->nomor_ijazah ?? null,
                'tanggal_ijazah' => $data->tanggal_ijazah ?? null,
                'asal_pesantren' => $data->asal_pesantren ?? null,
                'alamat_pesantren' => $data->alamat_pesantren ?? null,
                'asal_sekolah' => $data->asal_sekolah ?? null,
                'alamat_sekolah' => $data->alamat_sekolah ?? null,
                'hobi' => $data->hobi ?? null,
                'golongan_darah' => $data->golongan_darah ?? null,
                'berat_badan' => $data->berat_badan ?? null,
                'tinggi_badan' => $data->tinggi_badan ?? null,
                'penyakit' => $data->penyakit ?? null,
                'jenis_kelamin' => $data->jenis_kelamin ?? null,
                'kondisi_kemampuan' => $data->kondisi_kemampuan ?? null,
                'status' => $data->status ?? null,
            ];
        }

        return $result;
    }

    private function dosen($id): array
    {
        $data = Dosen::firstWhere('user_id', $id);

        $result = [
            'dosen' => false
        ];

        if ($data) {
            $result = [
                'dosen' => true,
                'nomor_induk' => $data->nomor_induk ?? null,
                'jabatan' => $data->jabatan ?? null,
                'tipe' => $data->tipe ?? null,
            ];
        }

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserProfileUpdateRequest $userRequest, DosenProfileUpdateRequest $dosenRequest, MahasantriProfileUpdateRequest $mahasantriRequest)
    {
        info($request->all());
        try {
            $this->updateUser($userRequest);

            if ($request->dosen == 1) {
                $this->updateDosen($dosenRequest);
            }

            if ($request->mahasantri == 1) {
                $this->updateMahasantri($mahasantriRequest);
            }

            $msg = 'Ok';
        } catch (\Throwable $th) {
            $msg = $th->getMessage();
        }

        return redirect()->back()->with('success', $msg);
    }

    protected function updateUser(UserProfileUpdateRequest $request): void
    {
        try {
            DB::beginTransaction();
            $request->user()->update($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            activity('error updateUser')->log($th->getMessage());
            DB::rollBack();
        }
    }

    protected function updateDosen(DosenProfileUpdateRequest $request): void
    {
        try {
            DB::beginTransaction();
            $request->user()->dosen->update($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            activity('error updateDosen')->log($th->getMessage());
            DB::rollBack();
        }
    }

    protected function updateMahasantri(MahasantriProfileUpdateRequest $request): void
    {
        try {
            DB::beginTransaction();
            $request->user()->mahasantri->update($request->validated());
            DB::commit();
        } catch (\Throwable $th) {
            activity('error updateMahasantri')->log($th->getMessage());
            DB::rollBack();
        }
    }
}
