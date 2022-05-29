<?php

namespace App\Http\Controllers;

use App\Models\ProductCategoriesDetails;
use App\Models\ProductImages;
use App\Models\AdminNotification;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Products;

class DashboardController extends Controller
{
    public function dashboard() {
        // $data = array('title' => 'Dashboard');
        $now = Carbon::now('Asia/Makassar');
        $allTransactions = Transaction::where('status', 'finish')->get();
        //dd($allTransactions);
        $allSales = Transaction::where('status','finish')->count();
        $monthlySales = Transaction::where('status','finish')->whereMonth('created_at', $now->month)->count();
        $annualSales = Transaction::where('status','finish')->whereYear('created_at', $now->year)->count();
        $monthlyTransactions = Transaction::where('status', 'finish')->whereMonth('created_at', $now->month)->get();
        $annualTranscations = Transaction::where('status', 'finish')->whereYear('created_at', $now->year)->get();
        //dd($allTransactions);
        $incomeTotal = 0;
        $incomeMonthly = 0;
        $incomeAnnual = 0;

        foreach ($allTransactions as $transaction) {
            $incomeTotal+=$transaction->total;
        }

        
        foreach ($monthlyTransactions as $monthly) {
            $incomeMonthly+=$monthly->total;
        }

        foreach ($annualTranscations as $annual) {
            $incomeAnnual+=$annual->total;
        }

        
        $january = Transaction::where('status', 'finish')->whereMonth('created_at', '01')->count();
        $february = Transaction::where('status', 'finish')->whereMonth('created_at', '02')->count();
        $march = Transaction::where('status', 'finish')->whereMonth('created_at', '03')->count();
        $april = Transaction::where('status', 'finish')->whereMonth('created_at', '04')->count();
        $may = Transaction::where('status', 'finish')->whereMonth('created_at', '05')->count();
        $june = Transaction::where('status', 'finish')->whereMonth('created_at', '06')->count();
        $july = Transaction::where('status', 'finish')->whereMonth('created_at', '07')->count();
        $august = Transaction::where('status', 'finish')->whereMonth('created_at', '08')->count();
        $september = Transaction::where('status', 'finish')->whereMonth('created_at', '09')->count();
        $october = Transaction::where('status', 'finish')->whereMonth('created_at', '10')->count();
        $november = Transaction::where('status', 'finish')->whereMonth('created_at', '11')->count();
        $december = Transaction::where('status', 'finish')->whereMonth('created_at', '12')->count();

        $title = "All Products";
        $active = "Posts";
        $products = Products::all();

        return view('admin.dashboard', compact(
            'title','active','products', 'now', 'allSales', 'monthlySales', 'annualSales', 'incomeTotal', 'incomeMonthly', 'incomeAnnual', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'
        ));

    }

    public function admin_notif($id) 
    {
        $notification = AdminNotification::find($id);
        $notif = json_decode($notification->data);
        $date = Carbon::now('Asia/Makassar');
        $baca = AdminNotification::find($id);
        $baca->read_at = $date;
        $baca->update();

        if ($notif->category == 'review' ) {
            return redirect()->route('productdetail',$notif->id);
        } else{
            return redirect()->route('transaksi-detail',$notif->id);
        } 
        
    }

    public function read_all_admin() 
    {
        $date = Carbon::now('Asia/Makassar');
        $baca= AdminNotification::all();
        //dd($baca);
        foreach($baca as $bacas){
            if($bacas->read_at == ''){
                $read = AdminNotification::find($bacas->id);
                $read->read_at =$date;
                $read->update();
            }
        }

        return redirect()->back();
    }
}
