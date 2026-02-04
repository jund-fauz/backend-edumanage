<?php

namespace App\Faker;

use Faker\Provider\Base;

class LessonProvider extends Base
{
    protected static $subjects = ['Matematika', 'Fisika', 'Kimia', 'Biologi', 'Sejarah', 'Bahasa Indonesia', 'Bahasa Inggris', 'TIK'];

    protected static $levels = ['Kelas 10', 'Kelas 11', 'Kelas 12'];

    public function lessonTitle(): array
    {
        return static::randomElements(static::$subjects, 2);
    }

    public function classroomTitle()
    {
        return static::randomElement(static::$levels);
    }
}
