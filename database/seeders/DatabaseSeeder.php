<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // generate user dari file UserFactory
        User::create([
          'name' => 'Achmad Syaiful Anand',
          'email' => 'achmadsyaifulanand@gmail.com',
          'username' => 'anandbersahaja',
          // 'password' => bcrypt($this->faker->word()), // password
          'password' => bcrypt('password'), // password
        ]);

        User::factory(4)->create();

        // generate post dari file PostFactory
        Post::factory(20)->create();
        

        Category::create([
            'name' => 'Software Engineering',
            'slug' => 'software-engineering'
        ]);
        Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development'
        ]);
        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);


        
    }
}
