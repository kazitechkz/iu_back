<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\CRUD;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Bpuig\Subby\Traits\HasSubscriptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Zorb\Promocodes\Traits\AppliesPromocode;

class User extends Authenticatable implements Searchable,Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use CRUD;
    use HasSubscriptions;
    use AppliesPromocode;
    use HasWallet;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "username",
        'name',
        'phone',
        'email',
        'password',
    ];
    protected $guard_name = 'web';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getSearchResult(): SearchResult
    {
        $url = route('user.edit', $this->id);
        return new SearchResult(
            $this,
            $this->username,
            $url
        );
    }
}
