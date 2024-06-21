<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fallible = [
        'borrower_name',
        'borrow_volume',
        'borrow_date',
        'monthly_payment',
    ];

    protected $table = 'loans';


}
