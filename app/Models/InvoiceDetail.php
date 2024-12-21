<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $table = 'invoice_details';

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function invoiceHeader()
    {
        return $this->belongsTo(InvoiceHeader::class);
    }
}
