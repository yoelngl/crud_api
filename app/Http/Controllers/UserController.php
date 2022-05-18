<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = User::latest()->get();
        return response()->json(['data' => $data]);
    }

    public function edit($id){
        $data = User::whereId($id)->first();
        return response()->json(['data' => $data]);
    }

    public function delete($id){
        $user = User::where('id',$id)->first();
        $data = User::whereId($id)->delete();
        return response()->json(['data' => $user,'message' => 'Data berhasil dihapus!']);
    }

    public function store(){
        if(request()->id){
            $nim = 'required|numeric|unique:users,nim,' . request()->id;
        }else{
            $nim = 'required|numeric|unique:users,nim';
        }

        request()->validate([
            'nim' => $nim,
            'name' => 'required',
            'address' => 'required',
            'major' => 'required',
        ]);

        $data = [
            'name' => request()->name,
            'nim' => request()->nim,
            'address' => request()->address,
            'major' => request()->major,
        ];

        try{
            if(request()->id){
                User::whereId(request()->id)->update($data);
                $user = User::where('id', request()->id)->first();
                return response()->json(['status' => true, 'data' =>  $user, 'message' => 'Data Mahasiswa berhasil diubah!']);
            }
            $data = User::create($data);
            return response()->json(['status' => true,'data' =>  $data, 'message' => 'Data Mahasiswa berhasil ditambahkan']);
        }catch(\Throwable $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
