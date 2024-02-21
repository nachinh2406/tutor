<?php

namespace Database\Factories;

use App\Models\ClassRegister;
use App\Models\ClassSchool;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassRegisterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $classId = ClassSchool::query()->inRandomOrder()->pluck('id')->first();
        $subjectId = Subject::query()->inRandomOrder()->pluck('id')->first();

        return [
            'code_class' => "VNA_".mt_rand(1000000, 9999999),
            'scope_class' => 1,
            'province_id' => 1,
            'district_id' => 1,
            'ward_id' => 1,
            'price_class' => 2000000,
            'fee__percentage_class' => 45,
            'number_lesson_week' => 2,
            'class_id' => $classId,
            'subject_id' => $subjectId,
            'gender_request' => 1,
            'role_user' => 1,
            'keyword' => Subject::find($subjectId)->name." ".ClassSchool::find($classId)->name_class,
            'embed_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1045.3546727826106!2d105.79957742416435!3d20.9837964934036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acc404316c27%3A0xdfb887e0181a7003!2zUC4gVHJp4buBdSBLaMO6YywgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1682161619299!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ];
    }
    protected $model = ClassRegister::class;
}
