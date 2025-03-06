<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
        // Membuat level
        Level::create([
            'level' => 'manager'
        ]);

        Level::create([
            'level' => 'cashier'
        ]);

        Level::create([
            'level' => 'admin'
        ]);

        // Membuat pengguna
        User::create([
            'level_id' => 1,
            'name' => 'Minara',
            'username' => 'manager',
            'password' => bcrypt('minara123'),
            'email' => 'minara@gmail.com', 
            'picture' => 'avatars-' . mt_rand(1, 8) . '.png'
        ]);

        User::create([
            'level_id' => 2,
            'name' => 'Amalia Febiana',
            'username' => 'cashier',
            'password' => bcrypt('amfeb19+'),
            'email' => 'amaliafebiana420@gmail.com', 
            'picture' => 'avatars-' . mt_rand(1, 8) . '.png'
        ]);

        User::create([
            'level_id' => 3,
            'name' => 'Muhamamd Ziqqi Pramudia',
            'username' => 'admin',
            'password' => bcrypt('ziqqi23'),
            'email' => 'kikic610@gmail.com',
            'picture' => 'avatars-' . mt_rand(1, 8) . '.png'
        ]);

        // Data menu
        $menuData = [
            [
                'name' => 'Carne Guisada',
                'modal' => 68000,
                'price' => 80000,
                'description' => '<div><strong>Consisting of<br></strong>- rice with, <strong><br></strong>- beef cut into small pieces and cooked in a blend of spices.</div>',
                'picture' => 'image.png',
                'category' => 'makanan'
            ],
            // Menu lainnya bisa ditambahkan di sini...
        ];

        // Daftar URL gambar untuk menu
        $imageUrls = [
            'https://i.ibb.co/cydkjWp/03r-Iwzuawxd-Zc-Hc-J6skw-Mcec-Y5i-GUOj-MPUgq-I1f-W.png',
            // URL lainnya...
        ];

        // Menyimpan menu dengan gambar
        foreach ($menuData as $key => $menu) {
            $filename = Str::random(40) . '.png';

            // Ambil gambar dengan cURL
            $imageData = $this->fetchImageWithCurl($imageUrls[$key]);
            Storage::put('menu/' . $filename, $imageData);

            // Update nama gambar di menu
            $menu['picture'] = 'menu/' . $filename;

            // Simpan menu ke database
            Menu::create($menu);
        }
    }

    // Fungsi untuk mengambil gambar dengan cURL
    private function fetchImageWithCurl($url)
    {
        // Inisialisasi cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Abaikan verifikasi SSL
        $data = curl_exec($ch);
        
        // Cek jika ada error
        if(curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        
        curl_close($ch);

        return $data;
    }
}
