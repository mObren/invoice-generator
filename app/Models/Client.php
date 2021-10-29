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
    //Filters for querying clients
    public function scopeFilter($query, array $filters) {
        if (isset($filters['search_company'])) {
            $query->where('company_name', 'like', "%" . request('search_company') . "%");
        } 
     
    }
    //Sum all invoices for a client
    public function getTotalToPay() {
        $total = 0;
        $invoices = $this->invoices;
        $invoices->load('items');
        foreach ($invoices as $invoice) {
            if ($invoice->status === 0) {
               foreach ($invoice->items as $item) {
                   $total += $item->price * $item->quantity;
               }
            }
        }
        return number_format($total, 2, ',', '.');
    }
    //Get all clients
    public static function fetchAllClients() {
        $user = User::getCurrentUser();
        $collection = Client::with('invoices')->where('user_id', $user->id);
        $clients = $collection->orderBy('company_name', 'ASC')->filter(request(['search_company']))->paginate(10);
        
        return $clients;
    }
}
