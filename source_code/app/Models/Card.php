<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Card
 * @package App\Models
 *
 * @property integer id
 * @property string front
 * @property string back
 * @property integer desk_id
 * @property string example
 * @property string audio
 * @property string image
 * @property string created_by
 * @property string updated_by
 * @property string created_at
 * @property string updated_at
 */
class Card extends Model
{

    protected $fillable = [
        'desk_id',
        'front',
        'back',
        'audio',
        'image',
        'example',
        'created_by',
        'updated_by'
    ];

    public function getAudioAttribute($value) {
        if ($value) {
            return url(parse_file_url($value));
        }
        return $value;
    }

    public function getImageAttribute($value) {
        if ($value) {
            return url(parse_file_url($value));
        }
        return $value;
    }

    public function desk() {
        return $this->belongsTo(Desk::class, 'desk_id');
    }
}
