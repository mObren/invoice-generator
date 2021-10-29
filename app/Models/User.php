<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
     public function clients() {
         return $this->hasMany(Client::class);
     }
     public function invoices() {
        return $this->hasManyThrough(Invoice::class, Client::class);
    }
     public function setPasswordAttribute($password) {
         $this->attributes['password'] = bcrypt($password);
     }
     public static function getCurrentUser() {
         return Auth::user();
     }
}
