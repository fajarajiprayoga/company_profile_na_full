<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Footer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'fajar.prayoga@students.amikom.ac.id',
        ]);

        $role = Role::create(['name' => 'super-admin']);
        $user->assignRole($role);

        $footer = new Footer;
        $footer->name = "Global Setting";
        $footer->address = "Address";
        $footer->youtube_url = "https://youtube.com";
        $footer->instagram_url = "https://instagram.com";
        $footer->instagram_username = "@username";
        $footer->facebook_url = "https://facebook.com";
        $footer->shopee_url = "https://shopee.com";
        $footer->tokopedia_url = "https://tokopedia.com";
        $footer->email = "email@gmail.com";
        $footer->background_product = "https://media.istockphoto.com/id/1149329096/id/foto/balon-udara-panas-di-atas-matahari-terbenam-gunung-moses-sinai.jpg?s=2048x2048&w=is&k=20&c=5TCuKMX-D_AgNPTCfYQMPpMD746wEJQ25AWWrqCc_kI=";
        $footer->background_contact = "https://media.istockphoto.com/id/1149329096/id/foto/balon-udara-panas-di-atas-matahari-terbenam-gunung-moses-sinai.jpg?s=2048x2048&w=is&k=20&c=5TCuKMX-D_AgNPTCfYQMPpMD746wEJQ25AWWrqCc_kI=";
        $footer->background_download_center = "https://media.istockphoto.com/id/1149329096/id/foto/balon-udara-panas-di-atas-matahari-terbenam-gunung-moses-sinai.jpg?s=2048x2048&w=is&k=20&c=5TCuKMX-D_AgNPTCfYQMPpMD746wEJQ25AWWrqCc_kI=";
        $footer->save();
    }
}
