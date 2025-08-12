<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;  // <-- import this
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AnonymousReport extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cat_id',
        'submitted_at',
        'location',
        '',
    ];

    public $timestamps = true;

    public function attachments(): HasMany
    {
        return $this->hasMany(AnonymousReportAttachment::class, 'report_id');
    }

    public function category()
{
    return $this->belongsTo(Category::class,'cat_id','cat_id');
}
}
