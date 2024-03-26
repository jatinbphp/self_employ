<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run() {

        User::create([
            'first_name' => 'Self',
            'last_name'  => 'Employee',
            'username' => 'admin',
            'email'      => 'admin@gmail.com',
            'password'   => 'password',
            'role_id'       => 1,
            'status'    => 'active',

            'address' => '23c, Lane 5 Bukhari Street',
            'address2' => 'DHA Phase 6',
            'city' => 'Karachi',
            'zip_code' => '74900',
            'state' => 'Sindh',
            'country' => 'Sindh',
            'phone' => '+92333333333',
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
            'identity_verified_at' => Carbon::now(),
            'payment_verified_at' => Carbon::now(),
            'company_name' => 'Labssol',
            'designation' => 'Owner',
            'about' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
        ]);

        User::create([
            'first_name' => 'Jhon',
            'last_name'  => 'Wrick',
            'username' => 'johnwrick',
            'email'      => 'john.wrick@gmail.com',
            'password'   => 'password',
            'role_id'    => 2,
            'status'     => 'active',
            'language_id' => 1,
            'category_id' => 1,

            'address' => '23c, Lane 5 Bukhari Street',
            'address2' => 'DHA Phase 6',
            'city' => 'Karachi',
            'zip_code' => '74900',
            'state' => 'Sindh',
            'country' => 'Sindh',
            'phone' => '+92333333333',
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
            'identity_verified_at' => Carbon::now(),
            'payment_verified_at' => Carbon::now(),
            'company_name' => 'Labssol',
            'designation' => 'Data Analytics Developer',
            'about' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."

        ]);

        User::create([
            'first_name' => 'David',
            'last_name'  => 'Sons',
            'username' => 'davidsons',
            'email'      => 'david.sons@gmail.com',
            'password'   => 'password',
            'role_id'    => 2,
            'status'     => 'active',
            'language_id' => 1,
            'category_id' => 1,

            'address' => '23c, Lane 5 Bukhari Street',
            'address2' => 'DHA Phase 6',
            'city' => 'Karachi',
            'zip_code' => '74900',
            'state' => 'Sindh',
            'country' => 'Sindh',
            'phone' => '+92333333333',
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
            'identity_verified_at' => Carbon::now(),
            'payment_verified_at' => Carbon::now(),
            'company_name' => 'Labssol',
            'designation' => 'Javascript Developer',
            'about' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
        ]);


        User::create([
            'first_name' => 'Vijesh',
            'last_name'  => 'Kumar',
            'username' => 'Vijesh',
            'email'      => 'vijesh.kumar@paceglobalpk.net',
            'password'   => 'password',
            'role_id'    => 2,
            'status'     => 'active',
            'language_id' => 1,
            'category_id' => 1,

            'address' => '23c, Lane 5 Bukhari Street',
            'address2' => 'DHA Phase 6',
            'city' => 'Karachi',
            'zip_code' => '74900',
            'state' => 'Sindh',
            'country' => 'Sindh',
            'phone' => '+92333333333',
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
            'identity_verified_at' => Carbon::now(),
            'payment_verified_at' => Carbon::now(),
            'company_name' => 'Labssol',
            'designation' => 'Frontend Developer',
            'about' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."

        ]);

        User::create([
            'first_name' => 'David',
            'last_name'  => 'Miller',
            'username' => 'davidmiler',
            'email'      => 'david.miler@gmail.com',
            'password'   => 'password',
            'role_id'    => 2,
            'status'     => 'active',
            'language_id' => 1,
            'category_id' => 1,

            'address' => '23c, Lane 5 Bukhari Street',
            'address2' => 'DHA Phase 6',
            'city' => 'Karachi',
            'zip_code' => '74900',
            'state' => 'Sindh',
            'country' => 'Sindh',
            'phone' => '+92333333333',
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
            'identity_verified_at' => Carbon::now(),
            'payment_verified_at' => Carbon::now(),
            'company_name' => 'Labssol',
            'designation' => 'Full Stack Developer',
            'about' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
        ]);

        User::create([
            'first_name' => 'Jhon',
            'last_name'  => 'Sons',
            'username' => 'johnsons',
            'email'      => 'john.sons@gmail.com',
            'password'   => 'password',
            'role_id'    => 2,
            'status'     => 'active',
            'language_id' => 1,
            'category_id' => 1,

            'address' => '23c, Lane 5 Bukhari Street',
            'address2' => 'DHA Phase 6',
            'city' => 'Karachi',
            'zip_code' => '74900',
            'state' => 'Sindh',
            'country' => 'Sindh',
            'phone' => '+92333333333',
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
            'identity_verified_at' => Carbon::now(),
            'payment_verified_at' => Carbon::now(),
            'company_name' => 'Labssol',
            'designation' => 'Software Developer',
            'about' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."

        ]);

        User::create([
            'first_name' => 'David',
            'last_name'  => 'John',
            'username' => 'davidjohn',
            'email'      => 'david.john@gmail.com',
            'password'   => 'password',
            'role_id'    => 2,
            'status'     => 'active',
            'language_id' => 1,
            'category_id' => 1,

            'address' => '23c, Lane 5 Bukhari Street',
            'address2' => 'DHA Phase 6',
            'city' => 'Karachi',
            'zip_code' => '74900',
            'state' => 'Sindh',
            'country' => 'Sindh',
            'phone' => '+92333333333',
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
            'identity_verified_at' => Carbon::now(),
            'payment_verified_at' => Carbon::now(),
            'company_name' => 'Labssol',
            'about' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
        ]);

    }
}
