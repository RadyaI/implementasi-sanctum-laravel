<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class siswaController extends Controller
{
    function getSiswa()
    {
        $get = siswa::get();
        return response()->json($get);
    }

    function selectSiswa($id) {
        $get = siswa::where('id_siswa',$id)->get();
            return response()->json($get);
    }

    function createSiswa(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'nama_siswa' => 'required|string|min:1',
            'gender' => 'required',
            'umur' => 'required|min:2|integer'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Validate failed',
                'status' => 'false',
                'result' => $validate->errors()
            ], 400);
        }

        $reqData = $req->all();
        siswa::create($reqData);
        return response()->json([
            'msg' => 'Success tambah siswa',
            'result' => $reqData
        ], 200);
    }

    function updateSiswa(Request $req, $id)
    {
        $validate = Validator::make($req->all(), [
            'nama_siswa' => 'required',
            'gender' => 'required',
            'umur' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'failed',
                'status' => false,
                'result' => $validate->errors()
            ], 400);
        }
        $reqData = $req->all();
        $update = siswa::where('id_siswa', $id)->update($reqData);
        return response()->json(['msg' => 'barhasil update siswa', 'result' => $reqData], 200);
    }

    function deleteSiswa($id)
    {
        $delete = siswa::where('id_siswa', $id)->delete();
        return response()->json(['msg' => 'Success delete siswa'], 200);
    }
}
