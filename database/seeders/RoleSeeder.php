<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $roles = collect([
                [
                    'id' => 'root',
                    'name' => 'GOD',
                    'description' => 'No limited access unless delete himself',
                    'permission' => 'rootPermissions'
                ],[
                    'id' => 'admin',
                    'name' => 'Administrator',
                    'description' => 'Role with all access',
                    'permission' => 'adminPermissions'
                ],[
                    'id' => 'contributor',
                    'name' => 'Contributor',
                    'description' => 'Can manage courses and enrollment',
                    'permission' => 'contributorPermissions'
                ]
            ]);
            $roles->each(function (array $item) {
                $permission = $this->definePermission($item['permission']);
                $permission->roles()
                    ->updateOrCreate(['id' => $item['id']], Arr::except($item, 'permission'));
            });
        });
    }

    protected function definePermission(string $id): Permission
    {
        $permissions = $this->permissions();
        $permission = $permissions[$id];

        return Permission::query()
            ->updateOrCreate(['id' => $id], [
                'id' => $id,
                'name' => $permission['name'],
                'privileges' => Arr::except($permission, 'name')
            ]);

        ['initiated_by' => 1, 'name' => 'Teknik Informatika - UNPAD'];

    }

    protected function permissions(): array
    {
        return [
            'rootPermissions' => [
                'name' => 'Root\'s Permissions',
                'users' => [
                    'allows' => ['*'],
                    'deny' => [
                        'create' => ['is:role_id,root','owned'],
                        'delete'=> ['is:role_id,root','owned'],
                    ],
                ],
                'roles' => [
                    'allows' => ['*'],
                    'deny' => [
                        'create' => ['owned'],
                        'delete'=> ['owned'],
                    ],
                ],
                'permissions' => [
                    'allows' => ['*'],
                    'deny' => [
                        'create' => ['is:id,rootPermissions','owned'],
                        'delete'=> ['is:id,rootPermissions','owned'],
                    ],
                ]
            ],
            'adminPermissions' => [
                'name' => 'Admin\'s Permissions',
                'users' => [
                    'allows' => ['*'],
                    'deny' => [
                        'view' => ['is:role_id,root'],
                        'viewDetail' => ['is:role_id,root'],
                        'delete'=> ['is:role_id,root','owned'],
                        'flush'=> ['is:role_id,root','owned'],
                    ],
                ],
                'roles' => [
                    'allows' => ['*'],
                    'deny' => [
                        'view' => ['is:id,root'],
                        'viewDetail' => ['is:id,root'],
                        'delete'=> ['is:id,root|admin','owned'],
                        'flush'=> ['is:id,root|admin','owned'],
                    ],
                ],
                'permissions' => [
                    'allows' => ['*'],
                    'deny' => [
                        'update' => ['is:id,rootPermissions|adminPermissions'],
                        'delete'=> ['is:id,rootPermissions|adminPermissions'],
                    ],
                ]
            ],
            'contributorPermissions' => [
                'name' => 'Contributor\'s Permissions',
                'users' => [
                    'allows' => [
                        'view', 'viewDetail', 'update', 'delete'
                    ],
                    'deny' => [
                        'view' => ['is:role_id,root'],
                        'viewDetail' => ['is:role_id,root'],
                        'delete' => ['is:role_id,root'],
                    ],
                ],
                'roles' => [
                    'allows' => ['view'],
                    'deny' => [
                        'view' => ['is:id,root'],
                        'viewDetail' => ['is:id,root'],
                    ],
                ],
                'resources' => [
                    'allows' => ['*'],
                    'deny' => [
                        'view' => ['not:status,published', 'notOwned'],
                        'viewDetail' => ['not:status,published', 'notOwned'],
                        'update' => ['notOwned'],
                        'delete' => ['notOwned'],
                        'restore' => ['notOwned'],
                        'publish' => ['notOwned'],
                        'flush' => ['notOwned'],
                    ],
                ],
            ],
        ];
    }
}
