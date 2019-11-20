<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Maintest::class);
    }
}
class Maintest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'=>'gnaveenkumar18.ng@gmail.com',
            'password'=>bcrypt(7483334815),
            'status'=>'active',
        ]);
        //$this->call(UsersTableSeeder::class);
        $this->command->info('admin added');
    }
}
