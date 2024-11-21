<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',
        'body',
    ];

//     for disable serialization
    protected $visible = [
        '*'
    ];

    public function author()
    {
     return $this->belongsTo(User::class, 'user_id');
    }
//    public function toArray(){
//        return [];
//    }


}
