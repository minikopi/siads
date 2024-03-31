<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PrestasiController extends Controller
{
    public function index()
    {
        return view('prestasi.index');
    }

    public function dataGet()
    {
        $data = Prestasi::with('mahasiswa')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->editColumn('nim', function ($data) {
                $mahasiswa = $data->mahasiswa->first(); // Assuming mahasiswa is a collection
                return optional($mahasiswa)->nim;
            })
            ->editColumn('nama', function ($data) {
                $mahasiswa = $data->mahasiswa->first(); // Assuming mahasiswa is a collection
                return $mahasiswa ? $mahasiswa->nama_depan . ' ' . $mahasiswa->nama_belakang : '';
            })
            ->editColumn('file', function ($data) {
                $filePath = asset($data->file);

                return '<a class="badge badge-sm btn-secondary" href="' . $filePath . '" target="_blank">View</a>';
            })
            ->rawColumns(['action', 'file'])
            ->make(true);
    }

    public function create()
    {
        return view('prestasi.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'prestasi' => 'required|string',
            'file' => 'required|file|mimes:pdf', // Adjust file validation rules as needed
        ]);

        // Handle file upload
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/prestasi'), $fileName);

        // Create a new Prestasi instance with default values
        $prestasi = new Prestasi([
            'mahasiswa_id' => Auth::user()->id,
            'prestasi' => $validatedData['prestasi'],
            'file' => 'uploads/prestasi/' . $fileName,
            'status' => 'Proses',
        ]);

        // Save the Prestasi instance to the database
        $prestasi->save();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi added successfully');
    }

    public function accept($id)
    {
        $prestasi = Prestasi::find($id);

        if ($prestasi) {
            $prestasi->update(['status' => 'Diterima']);

            return response()->json(['message' => 'Prestasi Diterima']);
        }

        return response()->json(['error' => 'Prestasi not found'], 404);
    }

    public function reject(Request $request, $id)
    {
        $prestasi = Prestasi::find($id);

        if ($prestasi) {
            $prestasi->update([
                'status' => 'Ditolak',
                'keterangan' => $request->input('reason')
            ]);
            return response()->json(['message' => 'Prestasi Ditolak']);
        }

        return response()->json(['error' => 'Prestasi not found'], 404);
    }
}
