<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Mission;
use App\Models\User;
use App\Models\Workperiod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'national_id'=>1,
            'first_name'=>'الدعم الفني',
            'full_name'=>'الفني',
            'user_type'=>'admin',
            'email'=>'admin',
            'password'=>Hash::make('admin@markaz'),
            'plain_password'=>'admin@markaz'
        ]);

        Workperiod::create([
            'title'=>'الفترة المسائية',
            'student_award_time'=>'25:51:23',
            'moderator_should_be_present_at'=>'25:51:23',
            'teacher_should_be_present_at'=>'25:51:23',
            'student_should_be_present_at'=>'25:51:23'
        ]);

        Mission::create([
            'title'=>'جزء تبارك',
            'note'=>'من سورة الملك إلى سورة المرسلات',
            'startfrom'=>562,
            'endto'=>581,
            'track_type'=>'new',
            'track_cate'=>'thomon',
            'allowed_wrong_number'=>2,
            'status'=>'active',
        ]);
    }
}
