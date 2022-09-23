<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends BaseController
{
    protected $feedback = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->middleware('auth:api');
        $this->feedback= $feedback;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
        //$feedback= $this->feedback->latest()->get();
        if($levelLogin === 'admin'){
            $feedback  = DB::table('feedback')
            ->join('kode_kantors', 'feedback.kantor_id', '=', 'kode_kantors.id')
            ->select('feedback.id','feedback.namafile','feedback.tanggal','feedback.file','feedback.view',
            'feedback.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $feedback  = DB::table('feedback')
            ->join('kode_kantors', 'feedback.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('feedback.id','feedback.namafile','feedback.tanggal','feedback.file','feedback.view',
            'feedback.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($feedback, 'Feedback list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'namafile' => 'required',
            'tanggal' => 'required',
            'file' => 'required|mimes:jpg'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'file.required' => 'nama file harus nama kantor (ex: cab-kpo.zip)',
            'file.mimes' => 'extensi gambar harus jpg atau png'
        ]);


        $nm         = $request->file('file');

        $hari       = substr($request->tanggal,8,2);
        $bulan      = substr($request->tanggal,5,2);
        $tahun      = substr($request->tanggal,0,4);
        $arr        = array($hari,"/",$bulan,"/",$tahun);
        $arrnamefile        = array($hari,$bulan,$tahun);
        $datefile   = implode("",$arrnamefile);

        $date       = implode("",$arr);

        $file   = "img_feedback".$request->kantor_id.".".$request->namafile.".".$datefile.".".$nm->getClientOriginalName();
        $feedback = $this->feedback->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
            'view'          => $file,
        ]);
        $nm->move(public_path().'/file/fb', $file);

        return $this->sendResponse($feedback, 'File telah diupload...');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $feedback = $this->feedback->findOrFail($id);

        $feedback->delete();
        $file = public_path("file/fb/".$feedback->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($feedback, 'Gambar sudah dihapus!');
        }else{
            unlink("file/fb/".$feedback->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($feedback, 'Gambar sudah dihapus!');
        }
    }

    public function downloadfile($id)
    {
        $feedback = $this->feedback->findOrFail($id);
        $file = public_path("file/fb/".$feedback->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
