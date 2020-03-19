<?php

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
        $this->create('can-register');
        $this->create('email-confirm', 'false');
        $this->create('google-login');
        $this->create('facebook-login');
    }

    private function create(string $name, string $value = 'true'): void {
        $config = new Configuration(['name' => $name, 'value' => $value]);
        $config->save();
    }
}
