<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_needed',
        'remarks',
        'user_id',
        'status'
    ];

    const SUBMITTED = 'Submitted';

    /**
     * Get all the documents for the application.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'application_id', 'id');
    }

    /**
     * Get the user that owns the application.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the for coding that onws the application.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function forCoding(): HasOne
    {
        return $this->hasOne(ForCoding::class, 'application_id', 'id');
    }
}
