<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;

class TimeOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:TimeOut';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set("Asia/Makassar");
            $transaksi = Transaction::where('timeout', '<', date('Y-m-d H:i:s'))->where('status', '=', 'unpaid')->get();
            if(!is_null($transaksi)){
                foreach($transaksi as $item){
                    $item->status = 'expired';
                    $item->save();
                }
            }
    }
}
