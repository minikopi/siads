<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    const Admin = 'admin';
    const Mahasantri = 'mahasantri';
    const Dosen = 'dosen';
    const Musyrif = 'musyrif';
    const PanitiaTakhrij = 'panitia_takhrij';

    public $guarded = [];
}
