<?php

namespace App\Http\Controllers\Tahfidz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tahfidz\SetoranStore;
use App\Http\Requests\Tahfidz\SetoranUpdate;
use App\Models\Dosen;
use App\Models\ExamEligibility;
use App\Models\Mahasantri;
use App\Models\QuranMemorization;
use App\Models\QuranMemorizationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        request()->session()->forget('setoran');
        $students = Mahasantri::where('status', 'aktif')->orderBy('nama_lengkap')->get();
        return view('tahfidz-section.setoran.index', compact('students'));
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
    public function store(SetoranStore $request)
    {
        $msg = 'Semoga lancar';
        $juz = $request->juz_number;

        try {
            DB::beginTransaction();

            // cek ketuntasan juz sebelumnya
            // kembalikan jika masih ada yang belum tuntas
            if ($request->juz_number > 1) {
                $cek = QuranMemorization::query()
                    ->where('mahasantri_id', $request->mahasantri_id)
                    ->where('status', 'tidak sah')
                    ->where('juz_number', '<', $juz)
                    ->orderBy('juz_number')
                    ->first();

                if ($cek) {
                    throw new \Exception("Juz {$cek->juz_number} masih ada yang belum tuntas.");
                }
            }

            // cek sudah ada datanya atau belum
            // buatkan jika belum ada
            $cek = QuranMemorization::query()
                ->where('mahasantri_id', $request->mahasantri_id)
                ->where('juz_number', $juz)
                ->first();

            if (!$cek) {
                for ($i = 1; $i <= 20; $i++) {
                    $data = new QuranMemorization();
                    $data->mahasantri_id = $request->mahasantri_id;
                    $data->juz_number = $juz;
                    $data->page_number = $i;
                    $data->created_by = $request->user()->name;
                    $data->save();
                }
            }

            // cek ketuntasan juz yang dipilih
            // kembalikan jika telah tuntas seluruhnya
            $cek = QuranMemorization::query()
                ->where('mahasantri_id', $request->mahasantri_id)
                ->where('status', 'tidak sah')
                ->where('juz_number', $juz)
                ->count();

            if ($cek == 0) {
                throw new \Exception("Juz {$juz} telah tuntas.");
            }

            $mahasantri = Mahasantri::findOrFail($request->mahasantri_id);

            // catat ke log
            $log = new QuranMemorizationLog();
            $log->mahasantri_id = $request->mahasantri_id;
            $log->mahasantri = $mahasantri->nama_lengkap;
            $log->nim = $mahasantri->nim;
            $log->juz_number = $juz;
            $log->created_by = $request->user()->name;
            $log->updated_by = $request->user()->name;
            $log->save();

            // catat session untuk keamanan
            $session = "mahasantri-{$request->mahasantri_id}-{$juz}";
            session(['setoran' => $session]);

            echo "oke siap";

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', $th->getMessage());
        }

        return to_route('tahfidz.setoran.show', $session)->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $setoran)
    {
        $msg = 'Terjadi kesalahan ';
        try {
            if ($request->session()->has('setoran') === false) {
                // ndak ada session
                throw new \Exception("{$msg} (001 - data not found).");
            }

            if (session('setoran') != $setoran) {
                // session ndak sama
                throw new \Exception("{$msg} (002 - wrong data).");
            }
        } catch (\Throwable $th) {
            return to_route('tahfidz.setoran.index')->with('error', $th->getMessage());
        }

        $data = explode('-', $setoran);
        $mahasantri_id = $data[1];
        $juz = $data[2];

        $items = QuranMemorization::query()
            ->with('dosen.user')
            ->where('mahasantri_id', $mahasantri_id)
            ->where('juz_number', $juz)
            ->orderBy('page_number')
            ->get();

        $mahasantri = Mahasantri::findOrFail($mahasantri_id);

        return view('tahfidz-section.setoran.show', compact('items', 'mahasantri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        echo $id;
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SetoranUpdate $request, string $setoran)
    {
        $mahasantri_id = $setoran;
        $juz_number = $request->juz_number;
        $page_number = $request->page_number;
        $msg = 'Terjadi kesalahan ';
        try {
            DB::beginTransaction();

            $dosen = Dosen::where([
                'user_id' => $request->user()->id
            ])->first();

            if (!$dosen) {
                throw new \Exception("{$msg}: (004 - Hanya dosen tahfidz yang dapat melakukan ini).");
            }

            $mahasantri = Mahasantri::find($mahasantri_id);

            if (!$mahasantri) {
                throw new \Exception("{$msg}: (005 - Data mahasantri tidak ditemukan).");
            }

            $session = "mahasantri-{$mahasantri_id}-{$request->juz_number}";
            if ($request->session()->has('setoran') === false) {
                // ndak ada session
                throw new \Exception("{$msg} (001 - data not found).");
            }

            if (session('setoran') != $session) {
                // session ndak sama
                throw new \Exception("{$msg} (002 - wrong data).");
            }

            $data = QuranMemorization::query()
                ->where('mahasantri_id', $mahasantri_id)
                ->where('juz_number', $juz_number)
                ->where('page_number', $page_number)
                ->first();

            // cek jika sudah sah, maka kembalikan lagi
            if ($data->status === QuranMemorization::SAH) {
                throw new \Exception("{$msg} (003 - sudah tuntas).");
            }

            // simpan data hafalan
            $data->dosen_id = $dosen->id;
            $data->updated_by = $request->user()->name;
            $data->status = QuranMemorization::SAH;
            $data->save();

            // jika sudah ke halaman 20, maka bolehkan untuk ujian
            // if ($page_number == 20) {
            //     $exam = new ExamEligibility();
            //     $exam->mahasantri_id = $mahasantri_id;
            //     $exam->semester = $juz_number;
            //     $exam->eligible = true;
            //     $exam->save();
            // }

            // catat ke log
            $log = new QuranMemorizationLog();
            $log->mahasantri_id = $mahasantri_id;
            $log->mahasantri = $mahasantri->nama_lengkap;
            $log->nim = $mahasantri->nim;
            $log->juz_number = $juz_number;
            $log->page_number = $page_number;
            $log->created_by = $request->user()->name;
            $log->updated_by = $request->user()->name;
            $log->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

        $msg = 'Berhasil disimpan.';
        return back()->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo $id;
        abort(404);
    }
}
