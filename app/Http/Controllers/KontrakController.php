<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontrak;
use App\Models\JabatanPegawai;
use App\Models\Pegawai;
use Response;

class KontrakController extends Controller
{
    public function index()
    {
        $kontrak = Kontrak::orderBy('id','desc')->get();
        return view('kontraks.index')->with(compact('kontrak'));
    }
    
    public function store(Request $request)
    {
        if ($request->id){
            $validatedData=$request->validate([
                'id' =>'required',
                'jabatan_pegawai_id' =>'required',
                'pegawai_id'=>'required',
                'lama_kontrak' => 'required'
                ]);
                $kontrak=Kontrak::where('id',$request->id)->update($validatedData);
        }
        else {
            $data = $request->validate([
                'jabatan_pegawai_id' => 'required',
                'pegawai_id' => 'required',
                'lama_kontrak' => 'required'
            ]);
            $kontrak = Kontrak::create($data);
        }
        return Response::json($kontrak);
    }
    public function getJabatan()
    {
        $jabatan=JabatanPegawai::all();
        return Response::json(['data'=>$jabatan]);
    }
    public function getPegawai()
    {
        $pegawai=Pegawai::all();
        return Response::json(['data'=>$pegawai]);
    }
    public function update(Request $request, Kontrak $kontrak)
    {
        $validatedData=$request->validate([
        'id' =>'required',
        'jabatan_pegawai_id' =>'required',
        'pegawai_id'=>'required',
        'lama_kontrak' => 'required'
        ]);
        Kontrak::where('id',$kontrak->id)->update($validatedData);
        return Response::json($kontrak);
    }
    public function destroy(Kontrak $kontrak)
    {
        Kontrak::destroy($kontrak->id);
        return redirect('')->with('pesan','Data Berhasil DiHapus');
    }
}
