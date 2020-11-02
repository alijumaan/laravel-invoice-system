<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function unitText()
    {
        if ($this->unit == 'piece') {
            $text = __('Frontend/frontend.Piece');
        } elseif ($this->unit == 'g') {
            $text = __('Frontend/frontend.Gram');
        } elseif ($this->unit == 'kg') {
            $text = __('Frontend/frontend.Kilo_gram');
        }

        return $text;
    }
}
