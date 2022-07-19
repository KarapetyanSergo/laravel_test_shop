<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const USER_TYPES = [
        'admins' => [
            'superadmin',
            'admin'
        ],
        'clients' => [
            'merchant',
            'customer'
        ]
    ];

    const TYPE_SUPER_ADMIN = 'superadmin';
    const TYPE_ADMIN = 'admin';
    const TYPE_MERCHANT = 'merchant';
    const TYPE_CUSTOMER = 'customer';

    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(ProductUser::class);
    }
}
