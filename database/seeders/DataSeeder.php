<?php

namespace Database\Seeders;

use App\Models\Programming;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ["Tutorials","Tips","Tricks","News","Updates","Reviews","Guides","How-to's","Best Practices","Resources"];
        $Programmings = ["PHP","JavaScript","Python","Java","C#","Ruby","Go","Swift","Kotlin","TypeScript"];

        foreach($tags as $t){
            Tag::create([
                'name'=>$t,
                'slug'=>Str::slug($t),
            ]);
        }
        foreach($Programmings as $p){
            Programming::create([
                'name'=>$p,
                'slug'=>Str::slug($p),
            ]);
        }
    }
}
