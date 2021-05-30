<?php

use App\Models\Posts\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Makanan',
            'slug' => 'makanan',
            'color' => '#fff'
        ]);
        Subject::create([
            'name' => 'Minuman',
            'slug' => 'minuman',
            'color' => '#fff'
        ]);
        Subject::create([
            'name' => 'Tambahan',
            'slug' => 'tambahan',
            'color' => '#fff'
        ]);
    }
}
