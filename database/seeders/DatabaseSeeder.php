<?php
// ...existing code...
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ...existing code...

        // Membuat role jika belum ada
        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        // Membuat permission jika belum ada
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users']);
        $viewDashboard = Permission::firstOrCreate(['name' => 'view dashboard']);

        // Berikan permission ke role superadmin dan admin
        $superadmin->givePermissionTo([$manageUsers, $viewDashboard]);
        $admin->givePermissionTo([$manageUsers, $viewDashboard]);
        $staff->givePermissionTo([$viewDashboard]);

        // Assign role ke user pertama (superadmin)
        $user = User::first();
        if ($user) {
            $user->assignRole('superadmin');
        }

        // Assign role staff ke user tertentu dan berikan permission khusus
        $staffUser = User::where('email', 'staff@gmail.com')->first();
        if ($staffUser) {
            $staffUser->assignRole('staff');
            $staffUser->givePermissionTo('manage users'); // hanya user ini yang dapat permission
        }
    }
}