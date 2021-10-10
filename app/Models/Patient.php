<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'address', 'mobile_number', 'email',  
    ];

    /**
     * Relationships
     */
    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    /**
     * Accessors
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getLastRecordAttribute()
    {
        $record = $this->records()->get()->last();
        return $record->bp_observation ?? '-';
    }
}
