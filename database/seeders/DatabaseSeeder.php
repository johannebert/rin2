<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Notifications\OneTimeNotification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $date = now()->addDays(60);

        $admin->notify(new OneTimeNotification('System', 'You are admin!', $date));

        User::factory(1000)->member()->create();

        set_time_limit(0);
        $users = User::all()->chunk(100);

        foreach ($users->lazy() as $chunk) {
            foreach ($chunk as $user) {
                $user->notify(new OneTimeNotification(
                    type: 'System',
                    message: 'Welcome in the new app RIN2!',
                    expiryDate: $date
                ));
            }
        }
    }
}
