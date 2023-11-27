
<?php

// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        // $adminRole = Role::create(['name' => 'admin']);
        // $editorRole = Role::create(['name' => 'editor']);
        // $teamLeader = Role::create(['name' => 'teamleader']);
        $executiveRole = Role::create(['name' => 'executives']);

        // // Create permissions
        $createPostPermission = Permission::create(['name' => 'create post']);
        // $editPostPermission = Permission::create(['name' => 'edit post']);
        // $uploadPermission = Permission::create(['name' => 'upload post']);

        // Assign permissions to roles
        // $adminRole->givePermissionTo([$createPostPermission, $editPostPermission, $deletePostPermission]);
        // $editorRole->givePermissionTo($createPostPermission);
        $executiveRole->givePermissionTo($createPostPermission);
        // $executiveRole->givePermissionTo(Permission::create(['name' => 'upload post']) );
    }
}
