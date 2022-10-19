<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $faker = Faker::create('id_ID');

        //User
        for ($i=0; $i < 2; $i++) {
            $role = ['Admin', 'Owner'];
            $email = ['admin@gmail.com', 'owner@gmail.com'];
            DB::table('users')->insert([
                'name' => $faker->name(),
                'role' => $faker->unique()->randomElement($role),
                'email' => $faker->unique()->randomElement($email),
                'password' => bcrypt('12345678')
            ]);
        }

        //User
        for ($i=0; $i < 10; $i++) {
            $nama = $faker->name();
            $email = str_replace(' ', '', $nama) . '@gmail.com';
            DB::table('users')->insert([
                'name' => $nama,
                'role' => 'Customer',
                'email' => $email,
                'password' => bcrypt('12345678')
            ]);
        }

        // Produk - Travel
        for ($i=0; $i < 20; $i++) {
            DB::table('tb_produk')->insert([
                'kategori' => 'Travel',
            ]);
        }

        // Produk - Bimbel
        for ($i=0; $i < 4; $i++) {
            DB::table('tb_produk')->insert([
                'kategori' => 'Bimbel',
            ]);
        }

        // Produk - Jasa Foto
        for ($i=0; $i < 4; $i++) {
            DB::table('tb_produk')->insert([
                'kategori' => 'Foto',
            ]);
        }

        // Master - Travel
        for ($i=0; $i < 20; $i++) {
            $harga = ['1000000', '2000000', '3000000', '4000000'];
            DB::table('tb_master_travel')->insert([
                'produk_id' => $faker->unique()->numberBetween(1,20),
                'nama_paket' => 'Liburan di ' . $faker->unique()->cityName(),
                'deskripsi_paket' => 'Full servis - Akomodasi Pulang Pergi | Makan 2x | Tempat-tempat iconik',
                'foto_paket' => 'dummyTravel.png',
                'harga_paket' => $faker->randomElement($harga),
                'tanggal_travel' => \Carbon\Carbon::now()->addMonths('1')->format('Y-m-d'),
                'waktu_travel' => \Carbon\Carbon::now()->addMonths('1')->format('H:i')
            ]);
        }

        // Master - Bimbel
        for ($i=0; $i < 4; $i++) {
            $jenjang = ['PAUD', 'SD', 'SMP', 'SMA'];
            $harga = ['200000', '250000', '270000', '300000'];
            $jadwal = ['Senin - Kamis', 'Kamis - Minggu'];
            $waktu = ['15:00', '17:00', '19:00'];
            DB::table('tb_master_bimbel')->insert([
                'produk_id' => $faker->unique()->numberBetween(21,24),
                'nama_paket' => 'Paket Belajar ' . $jenjang[$i],
                'deskripsi_paket' => 'Full servis - Tutor kompeten | Selama 2 jam | Tempat luas',
                'foto_paket' => 'dummyBimbel.png',
                'harga_paket' => $harga[$i],
                'jadwal_bimbel' => $faker->randomElement($jadwal),
                'waktu_bimbel' => $faker->randomElement($waktu)
            ]);
        }

        // Master - Jasa Foto
        for ($i=0; $i < 4; $i++) {
            $tingkat = ['I', 'II', 'III', 'IV'];
            $harga = ['1000000', '2000000', '3000000', '4000000'];
            DB::table('tb_master_jasa_foto')->insert([
                'produk_id' => $faker->unique()->numberBetween(25,28),
                'nama_paket' => 'Paket Fotography Tingkat ' . $tingkat[$i],
                'deskripsi_paket' => 'Full servis - Hasil cetak TOP | Hasil editing BAGUS | Kualitas kamera sesuai tingkat paket',
                'foto_paket' => 'dummyFoto.png',
                'harga_paket' => $harga[$i],
            ]);
        }
    }
}
