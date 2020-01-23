<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = [];

    const  ROLE_SALES_MANAGER = 1;
    const  ROLE_SALES_DIRECTOR = 2;
    const  ROLE_SALES_REPRESENTATIVE = 3;

    public function users()
    {
        return $this->belongsToMany(User::class)->orderByDesc('started_at');
    }

    public function roleLabel()
    {
        $list = self::listRolesWithId();
        return $list[$this->type][1];
    }


    public static function listRolesWithId()
    {
        return [
            self::ROLE_SALES_MANAGER => [self::ROLE_SALES_MANAGER, 'Satış Müdürü'],
            self::ROLE_SALES_DIRECTOR => [self::ROLE_SALES_DIRECTOR, 'Satış Direktörü'],
            self::ROLE_SALES_REPRESENTATIVE => [self::ROLE_SALES_REPRESENTATIVE, 'Satış Temsilcisi'],
        ];
    }
}
