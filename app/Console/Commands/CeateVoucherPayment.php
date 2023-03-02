<?php

namespace App\Console\Commands;

use App\Models\Voucher;
use Illuminate\Console\Command;

class CeateVoucherPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voucher.buy {code : The customer code}';

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

        $voucherCode = $this->argument('code');

        Voucher::create([
            'code' => $voucherCode,
            'voucher_group_id' => null,
            'note' => 'Auto-Created by Command access',
            'upload' => 1000,
            'download' => 3000,
            'limit' => null,
            'used' => 0,
        ]);


        return Command::SUCCESS;
    }
}
