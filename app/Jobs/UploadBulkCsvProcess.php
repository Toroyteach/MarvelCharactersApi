<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\UploadCsv;
use Carbon\Carbon;

class UploadBulkCsvProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data   = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     * Inserts results from the job to the table
     *
     * @return void
     */
    public function handle()
    {

        foreach($this->data as $sales){

            $saleData = array_combine($this->header, $sales);

            UploadCsv::create([
                'invoice_no' => $saleData['invoice_no'],
                'stock_code' => $saleData['stock_code'],
                'description' => $saleData['description'],
                'quantity' => $saleData['quantity'],
                'invoice_date' => Carbon::parse($saleData['invoice_date']),
                'unit_price' => $saleData['unit_price'],
                'customer_id' => $saleData['customer_id'],
                'country' => $saleData['country'],
            ]);

        }

    }
}
