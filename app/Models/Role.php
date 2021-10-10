<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Staff Roles
     */
    public const Admin = 1;
    public const Nurse = 2;
    public const Doctor = 3;
}
