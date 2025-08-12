<?php

namespace App\Models;  // <-- add this

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\AnonymousReport;  // <-- add this to use the related model

class AnonymousReportAttachment extends Model
{
    protected $fillable = [
        'report_id',
        'file_path',
        'file_type',
        'original_filename',
    ];

    public function anonymousReport(): BelongsTo
    {
        return $this->belongsTo(AnonymousReport::class, 'report_id', 'reprt_id');
    }
}
