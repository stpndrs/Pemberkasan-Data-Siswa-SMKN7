<?php

namespace App\Http\Controllers;

use App\Models\BerkasModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UploadController extends Controller
{
    public function upload()
    {
        $siswa = SiswaModel::all();

        $data = [
            'siswa' => $siswa
        ];

        return view('upload', $data);
    }

    public function save(Request $request)
    {
        $validated = [
            'user_id' => 'required',
            'fileKK' => 'required|mimes:jpg,jpeg,png,pdf',
            'fileAkta' => 'required|mimes:jpg,jpeg,png,pdf',
            'fileIjazah' => 'required|mimes:jpg,jpeg,png,pdf',
        ];
        $customMessages = [
            'user_id.required' => 'Nama Siswa Harus Diisi!',
            'fileKK.required' => 'File KK Harus Diisi!',
            'fileAkta.required' => 'File Akta Harus Diisi!',
            'fileIjazah.required' => 'File Ijazah Harus Diisi!',
            // 'fileKK.mimes:jpg' => 'File KK Harus Berupa jpg, jpeg, png, atau pdf'
        ];
        $this->validate($request, $validated, $customMessages);
        $cariBerkas = BerkasModel::where('user_id', $request->user_id)->first();

        $request->file('fileKK')->storeAs(
            'berkas-kk',
            $request->file('fileKK')->getClientOriginalName()
        );
        $request->file('fileAkta')->storeAs(
            'berkas-akta-lahir',
            $request->file('fileAkta')->getClientOriginalName()
        );
        $request->file('fileIjazah')->storeAs(
            'berkas-ijazah',
            $request->file('fileIjazah')->getClientOriginalName()
        );

        BerkasModel::create([
            'user_id' => $request->user_id,
            'fileKK' => $request->file('fileKK')->getClientOriginalName(),
            'fileAkta' => $request->file('fileAkta')->getClientOriginalName(),
            'fileIjazah' => $request->file('fileIjazah')->getClientOriginalName()
        ]);

        return redirect()->to('/')->with('status', 'Berhasil menambah data baru!');
    }
}
