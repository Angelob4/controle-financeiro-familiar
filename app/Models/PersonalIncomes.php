<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalIncomes extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value','payment_date','is_income'];


    /**
     * Get the user's payment date.
     */
    protected function paymentDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d-m-Y')
        );
    }

    public function scopeGetFullRelatory() {
            return false;
    }

    function scopeGetByYear($query, $year){

        return $query->whereYear('payment_date', $year);
    }

    function scopeGetByMonthYear($query, $month, $year){
        return $query->whereMonth('payment_date', $month)->whereYear('payment_date', $year);
    }

}
