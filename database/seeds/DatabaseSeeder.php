<?php
    
    use App\Permission;
    use App\Role;
    use Carbon\Carbon;
    use Illuminate\Database\Seeder;
    use App\User;
    use App\Record;
    use Illuminate\Support\Str;
    
    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
            // $this->call(UserSeeder::class);
            $metrica_admin = User::create([
                'name' => 'Metrica Admin',
                'email' => 'k.dragnev@metrica.bg',
                'email_verified_at' => now(),
                'password' => '12345678', //
//                'password' => 'password',
                'remember_token' => Str::random(10),
            ]);
            $toyota_balkans = User::create([
                'name' => 'Toyota Balkans',
                'email' => 'hgbuotdz@sharklasers.com',
                'email_verified_at' => now(),
                'password' => '12345678', //
                'remember_token' => Str::random(10),
            ]);
            $administrator = Role::create([
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $manager = Role::create([
                'name' => 'Manager',
                'slug' => 'manager',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $dealer = Role::create([
                'name' => 'Dealer',
                'slug' => 'dealer',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $metrica_admin->roles()->attach($administrator);
            $toyota_balkans->roles()->attach($manager);
            
            factory(User::class, 13)->create();
            factory(Record::class, 15)->create();
            
        }
    }
