<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
public function run()
{
$permissions = [
'create users',
'edit users',
'delete users',
'view users',
// tambahkan permissions lain sesuai kebutuhan
];

foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}
