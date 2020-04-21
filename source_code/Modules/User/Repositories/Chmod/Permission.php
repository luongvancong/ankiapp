<?php

namespace Modules\User\Repositories\Chmod;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Repositories\User;

class Permission extends Model
{
   protected $guarded = ['_token'];
   protected $primaryKey = 'name';
   protected $keyType = 'string';
   protected $fillable = [
       'name', 'display_name', 'description'
   ];

   public function users() {
       return $this->belongsToMany(User::class, 'users_permissions', 'permission_name', 'user_id');
   }
}
