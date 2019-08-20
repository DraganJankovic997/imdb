<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Genre::GENRES as $val){
            Genre::insert([
                'name' => $val
            ]);
        }
    }
}

