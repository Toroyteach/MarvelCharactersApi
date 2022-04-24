<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadCsv extends Model
{
    use HasFactory;

    protected $table = 'upload_csv';

    protected $fillable = ['invoice_no', 'stock_code', 'description', 'quantity', 'invoice_date', 'unit_price', 'customer_id', 'country'];

    protected $dates = [
        'invoice_date',
    ];
}
