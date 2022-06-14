<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder {
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run() {
//      dd(Tag::inRandomOrder()->limit(mt_rand(2,10))->get()->toArray());
      Post::factory()->count(100)->create();
      Post::chunk(20, function ($posts) {
         foreach ($posts as $post) {
            $tags = Tag::inRandomOrder()->limit(mt_rand(2, 10))->pluck("id")->toArray();
            $post->tags()->sync($tags);
         }
      });
   }
}
