<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Item extends Model
{
    use HasFactory;
    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];
    //Get the invoice item belongs to
    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
