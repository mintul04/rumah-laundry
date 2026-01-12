<?php

namespace App\Console\Commands;

use App\Jobs\CheckExpiredTransaksi;
use Illuminate\Console\Command;
use App\Models\Transaksi;

class CheckExpired extends Command
{
    protected $signature = 'bill:check-expired';
    protected $description = 'Scan transaksi dengan status "selesai" dan tanggal_jatuhtempo';

    public function handle(): void
    {
        CheckExpiredTransaksi::dispatch();
    }
}
