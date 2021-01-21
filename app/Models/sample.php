<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sample extends Model
{
    use HasFactory;
    protected $table = 'sample';
    protected $primaryKey = "id";
    protected $fillable = [
        'filename','fname', 'lname', 'username','password', 'address', 'phone', 'gender', 'role', 'email'
    ];
}
