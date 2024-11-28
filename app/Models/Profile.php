<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'webpage',
        'image'
    ];

    public function getProfilePhoto(){
        return $this->image ?? "\profile\CQZ8obZ5mhx1rNTZLn6xW6ILWc4KZ46Yfn5bzTdC.jpg";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follow(){
        return $this->hasMany(Follow::class);
    }
}
