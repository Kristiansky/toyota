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
    
            $nikkom = User::create([
                'name' => 'Ником Русе',
                'email' => 'webleads@nikkom.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $nikkom->roles()->attach($dealer);
            
            $carcom = User::create([
                'name' => 'Карком Варна',
                'email' => 'webleads@carcom.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $carcom->roles()->attach($dealer);
    
            $via = User::create([
                'name' => 'Виа Интеркар Плевен',
                'email' => 'webleads@via.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $via->roles()->attach($dealer);
    
            $mototom = User::create([
                'name' => 'Мототом Добрич',
                'email' => 'webleads@mototom.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $mototom->roles()->attach($dealer);
    
            $monza = User::create([
                'name' => 'Монца Благоевград',
                'email' => 'webleads@monza.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $monza->roles()->attach($dealer);
    
            $tscvt = User::create([
                'name' => 'ТСЦ Велико Търново',
                'email' => 'webleads@tscvt.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $tscvt->roles()->attach($dealer);
    
            $tixim_pz = User::create([
                'name' => 'Тиксим Пазарджик',
                'email' => 'webleads@tixim-pz.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $tixim_pz->roles()->attach($dealer);
    
            $tixim_pl = User::create([
                'name' => 'Тиксим Пловдив',
                'email' => 'webleads@tixim-pl.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $tixim_pl->roles()->attach($dealer);
    
            $globalcar = User::create([
                'name' => 'Глобалкар Ст.Загора',
                'email' => 'webleads@globalcar.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $globalcar->roles()->attach($dealer);
    
            $kale = User::create([
                'name' => 'Кале Ауто Сливен',
                'email' => 'webleads@kale.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $kale->roles()->attach($dealer);
    
            $polymotors = User::create([
                'name' => 'Полихронов Мотърс Хасково',
                'email' => 'webleads@polymotors.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $polymotors->roles()->attach($dealer);
    
            $spektaauto = User::create([
                'name' => 'СПЕКТА Ауто Бургас',
                'email' => 'webleads@spektaauto.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $spektaauto->roles()->attach($dealer);
    
            $tmauto = User::create([
                'name' => 'ТМ Ауто София',
                'email' => 'webleads@tmauto.toyota.bg',
                'email_verified_at' => now(),
                'password' => 'webleads', //
                'remember_token' => Str::random(10),
            ]);
            $tmauto->roles()->attach($dealer);

//            factory(User::class, 13)->create();
            factory(Record::class, 15)->create();
        
        }
    }
