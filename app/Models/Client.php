<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;



    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function items() {
        return $this->hasManyThrough(Item::class, Invoice::class);
    }


    public function getTotalToPay() {
        $total = 0;

        $items = $this->items;
        foreach ($items as $item) {
            $total+= $item->price * $item->quantity;
        }
        return $total;
    }

    public static function fetchAllClients() {
        $user = User::getCurrentUser();

        $clients = Client::with('invoices')->where('user_id', $user->id)->get();

        return $clients;
    }
}
