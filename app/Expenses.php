<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'expense_category_id', 'amount', 'entry_date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\ExpenseCategories', 'expense_category_id');
    }
}
