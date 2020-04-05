<?php

use Illuminate\Database\Seeder;
use App\Channel;

class CreateChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = Channel::create([
            'name' => 'laravel',
            'slug' => 'laravel'
        ]);
        $channel2 = Channel::create([
            'name' => 'Vue js',
            'slug' => 'Vue-js'
        ]);
        $channel1 = Channel::create([
            'name' => 'Angular',
            'slug' => 'angular'
        ]);
        $channel1 = Channel::create([
            'name' => 'React js',
            'slug' => 'react-js'
        ]);
    }
}
