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

        // return redirect()->to('/')->with('status', 'Berhasil menambah data baru!');

        // return Response()->json([
        //     "success" => true,
        //     "berkas" => $cariBerkas
        // ]);
    }

    public function update(Request $request, $id)
    {
        $cariBerkas = BerkasModel::join('tb_user', 'tbberkas_berkas.user_id', 'tb_user.id_user')
        ->where('id', $id)->first();

        if ($request->file('fileKK') == null) {
            $fileKK = $cariBerkas->fileKK;
        } else {
            $fileKK = $request->file('fileKK')->getClientOriginalName();
        }
        if ($request->file('fileAkta') == null) {
            $fileAkta = $cariBerkas->fileAkta;
        } else {
            $fileAkta = $request->file('fileAkta')->getClientOriginalName();
        }
        if ($request->file('fileIjazah') == null) {
            $fileIjazah = $cariBerkas->fileIjazah;
        } else {
            $fileIjazah = $request->file('fileIjazah')->getClientOriginalName();
        }
        BerkasModel::where('id', $id)
        ->update([
            'fileKK' => $fileKK,
            'fileAkta' => $fileAkta,
            'fileIjazah' => $fileIjazah
        ]);
        // ;
    }

    public function cekBerkas($nisn)
    {
        $cariBerkas = BerkasModel::join('tb_user', 'tbberkas_berkas.user_id', 'tb_user.id_user')
        ->where('user_id', $nisn)->first();

        // if ($cariBerkas) {
            return response()->json($cariBerkas);
        // }
    }
}
