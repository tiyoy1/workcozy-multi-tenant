<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Workspace;
use App\Models\Membership;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Mimin',
            'email' => 'mimin@gmail.co',
            'password' => Hash::make('Admin12345!'),
        ]);

        $slug = Str::of($user->name . ' Workspace')->slug('-');

        $workspace = Workspace::create([
            'name' => $user->name,
            'slug' => $slug,
        ]);

        Membership::create([
            'membership_role' => 'owner',
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // $user->workspaces()->attach($workspace->id);
    }
}
