<?php

namespace Database\Seeders;

use App\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('can-register', 'true');
        $this->create('email-confirm');
        $this->create('google-login');
        $this->create('facebook-login');
    }

    private function create(string $name, string $value = 'false'): void {
        $config = new Configuration();
        $config->name  = $name;
        $config->value = $value;
        $config->save();
    }
}
