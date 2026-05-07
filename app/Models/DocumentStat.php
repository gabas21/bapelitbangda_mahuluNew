<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentStat extends Model
{
    protected $table = 'document_stats';

    protected $fillable = [
        'doc_key',
        'type',
        'category',
        'views',
        'downloads',
    ];

    /**
     * Get or create a stat record for this document key.
     */
    public static function findOrCreate(string $docKey, string $type, string $category): self
    {
        return self::firstOrCreate(
            ['doc_key' => $docKey],
            ['type' => $type, 'category' => $category, 'views' => 0, 'downloads' => 0]
        );
    }

    /**
     * Increment views count atomically.
     */
    public static function incrementViews(string $docKey, string $type, string $category): self
    {
        $stat = self::findOrCreate($docKey, $type, $category);
        $stat->increment('views');
        return $stat->fresh();
    }

    /**
     * Increment downloads count atomically.
     */
    public static function incrementDownloads(string $docKey, string $type, string $category): self
    {
        $stat = self::findOrCreate($docKey, $type, $category);
        $stat->increment('downloads');
        return $stat->fresh();
    }
}
