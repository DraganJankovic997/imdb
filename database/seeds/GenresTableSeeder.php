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
        $genres = [Genre::GENRE_ACTION, Genre::GENRE_ADVENTURE, Genre::GENRE_SPORTS,
             Genre::GENRE_DOCUMENTARY,Genre::GENRE_THRILLER, Genre::GENRE_HORROR, Genre::GENRE_COMEDY];
        foreach($genres as $val){
            Genre::insert([
                'name' => $val
            ]);
        }
    }
}