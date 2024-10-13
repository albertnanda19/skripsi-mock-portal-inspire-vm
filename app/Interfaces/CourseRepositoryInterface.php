<?php

namespace App\Interfaces;

use App\Entities\CourseEntity;

interface CourseRepositoryInterface
{
    public function getAllCourses(): array;
}