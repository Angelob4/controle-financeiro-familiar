<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalExpenses extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value','payment_date','is_paid'];

    function scopeGetByYear($query, $year){

        return $query->whereYear('payment_date', $year);
    }


    function scopeGetByMonthYear($query, $month, $year){
        return $query->whereMonth('payment_date', $month)->whereYear('payment_date', $year);
    }
}
