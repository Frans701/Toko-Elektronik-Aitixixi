<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\ProductReview;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaction.index', [
            'title' => 'Transaction',
            'transactions' => Transaction::orderBy('created_at', 'DESC')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaction::with(['user','transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('images');
            }]);
        }, 'courier'])->find($id);
        $title = 'Detail Transaction';
        $detail_transaksi = TransactionDetail::where('transaction_id', '=', $transaksi->id)->first();
        $product_review = ProductReview::where('product_id', '=', $detail_transaksi->product_id)->first();
        return view('admin.transaction.edit', compact('transaksi', 'title', 'product_review'));
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
        //
    }

    public function verified(Request $request){
        $data= array(
            'status' => $request->status
        ); 
        $transaksi = Transaction::find($request->id);
        
        $transaksi->update($data);

        $transaction = Transaction::find($request->id);
        $tanggal = Carbon::now();
        $user = User::find($transaction->user_id);

        $data = [
            'nama'=> 'Admin',
            'message'=>'sudah tervirifikasi',
            'id'=> $request->id,
            'category' => 'transaction'
        ];

        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('/admin/transaction/'.$request->id.'/edit');
        
    }

    public function kirim(Request $request){
        $data= array(
            'status' => $request->status
        ); 
        $transaksi = Transaction::find($request->id);
        
        $transaksi->update($data);

        $transaction = Transaction::find($request->id);
        $tanggal = Carbon::now();
        $user = User::find($transaction->user_id);

        $data = [
            'nama'=> 'Admin',
            'message'=>'barang dikirim',
            'id'=> $request->id,
            'category' => 'transaction'
        ];

        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect('/admin/transaction/'.$request->id.'/edit');
        
    }

}
