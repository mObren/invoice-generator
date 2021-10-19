<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getTotal() {
        $total = 0;
        $items = $this->items;
        foreach ($items as $item) {
            $total+= $item->price * $item->quantity;

        }
        return $total;
    }

 

}
