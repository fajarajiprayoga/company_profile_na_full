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

        Permission::create(['name' => 'view-contact']);
        Permission::create(['name' => 'create-contact']);
        Permission::create(['name' => 'update-contact']);
        Permission::create(['name' => 'delete-contact']);
        
        Permission::create(['name' => 'view-footer']);
        Permission::create(['name' => 'create-footer']);
        Permission::create(['name' => 'update-footer']);
        Permission::create(['name' => 'delete-footer']);
        
        Permission::create(['name' => 'view-gallery']);
        Permission::create(['name' => 'create-gallery']);
        Permission::create(['name' => 'update-gallery']);
        Permission::create(['name' => 'delete-gallery']);
        
        Permission::create(['name' => 'view-product']);
        Permission::create(['name' => 'create-product']);
        Permission::create(['name' => 'update-product']);
        Permission::create(['name' => 'delete-product']);
        
        Permission::create(['name' => 'view-slider']);
        Permission::create(['name' => 'create-slider']);
        Permission::create(['name' => 'update-slider']);
        Permission::create(['name' => 'delete-slider']);
        
        Permission::create(['name' => 'view-type']);
        Permission::create(['name' => 'create-type']);
        Permission::create(['name' => 'update-type']);
        Permission::create(['name' => 'delete-type']);
        
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);

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
