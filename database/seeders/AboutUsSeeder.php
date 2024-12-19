<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\Privecy;
use App\Models\TermUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = new AboutUs();
        $about->title_ar = 'من نحن';
        $about->title_en = 'من نحن';
        $about->body_ar = 'من نحن';
        $about->body_en = 'من نحن';
        $about->image = '#';
        $about->save();

        $about = new TermUser();
        $about->title_ar = 'term';
        $about->title_en = 'term';
        $about->body_ar = 'term';
        $about->body_en = 'term';
        $about->image = '#';
        $about->save();

        $about = new Privecy();
        $about->title_ar = 'privecies';
        $about->title_en = 'privecies';
        $about->body_ar = 'privecies';
        $about->body_en = 'privecies';
        $about->image = '#';
        $about->save();
    }
}
