<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    function login(Request $req)
    {
        $getEmail = $req->email;
        $password = $req->password;

        $checkExist = User::where('email', $getEmail)->first();
        if (!$checkExist || !Hash::check($password, $checkExist->password)) {
            return response()->json([
                'msg' => 'email ' . $getEmail . ' tidak ditemukan'
            ], 404);
        }

        $role = $checkExist->role;
        $email = $checkExist->email;
        $nama = $checkExist->name;
        $token = $checkExist->createToken($nama)->plainTextToken;
        return response()->json([
            'nama' => $nama,
            'email' => $email,
            'role' => $role,
            'token' => $token,
            'tokenID' => $checkExist->id
        ], 200);
    }

    function logout(Request $req)
    {
        $checkID = DB::table('personal_access_tokens')->orderBy('id','desc')->first();
        $id = $checkID->id;
        if ($id >= 99) {
            DB::table('personal_access_tokens')->truncate();
            return response()->json(['msg' => 'data truncate success']);
        }
        $delete = DB::table('personal_access_tokens')->where('id', $req->tokenID)->delete();
        return response()->json(['msg' => 'Berhasil logout dengan id ' . $req->tokenID]);
    }
}
