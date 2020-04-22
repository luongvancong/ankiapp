<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Repositories\User;

/**
 * Class Desk
 * @package App\Models
 *
 * @property integer id
 * @property string name
 * @property string created_by
 * @property string updated_by
 * @property string created_at
 * @property string updated_at
 */
class Desk extends Model
{

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'created_by',
        'updated_by'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function cards() {
        return $this->hasMany(Card::class, 'desk_id');
    }
}
