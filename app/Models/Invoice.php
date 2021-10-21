<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Invoice extends Model
{
    use HasFactory;


    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    protected $dates = ['date', 'valute'];

    public function client() {
        return $this->belongsTo(Client::class);
    }
    
    public function user() {
        return $this->client->user;
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function scopeFilter($query, array $filters) {

        if (isset($filters['search_company'])) {
            $query->whereRelation('client', 'company_name', 'like', "%" . request('search_company') . "%");
        } 
        if (isset($filters['search_status'])) {
            $query->where('status', request('search_status'));
        }
        if (isset($filters['search_date_from'])) {
            $query->where('date', '>=', request('search_date_from'));
        }
        if (isset($filters['search_date_to'])) {
            $query->where('date', '<=', request('search_date_to'));
        }
        if (isset($filters['search_valute_from'])) {
            $query->where('valute', '>=', request('search_valute_from'));
        }
        if (isset($filters['search_valute_to'])) {
            $query->where('valute', '<=', request('search_valute_to'));
        }
     
    }

    public function getTotal() {
        $total = 0;
        $items = $this->items;
        foreach ($items as $item) {
            $total+= $item->price * $item->quantity;

        }
        return $total;
    }

}
