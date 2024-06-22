<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    /**
     * Get the application that owns the document.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
