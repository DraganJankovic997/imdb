<?php

use Illuminate\Database\Seeder;
use App\Emote;

class EmoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       foreach(Emote::EMOTES as $value) {
           Emote::insert([
            'name' => $value
           ]);
       }
    }
}
