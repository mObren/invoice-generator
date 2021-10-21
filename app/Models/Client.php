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
    public function scopeFilter($query, array $filters) {

        if (isset($filters['search_company'])) {
            $query->where('company_name', 'like', "%" . request('search_company') . "%");
        } 
     
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

        $collection = Client::with('invoices')->where('user_id', $user->id);

        $clients = $collection->filter(request(['search_company']))->get();
        


        return $clients;
    }
}
