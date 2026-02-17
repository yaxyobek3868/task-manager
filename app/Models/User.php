<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @method static create(array $array)
 * @method static where(string $string, int $value)
 * @property mixed $id
 * @property mixed $role
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'status',
    ];


    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'role' => UserRole::class,
        'status' => UserStatus::class,
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

}
