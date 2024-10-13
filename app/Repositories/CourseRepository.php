<?php

namespace App\Repositories;

use App\Interfaces\CourseRepositoryInterface;
use App\Entities\CourseEntity;
use Config\Database;

class CourseRepository implements CourseRepositoryInterface
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAllCourses(): array
    {
        $query = $this->db->query("SELECT course_id, course_code, course_name FROM courses");
        return $query->getResult(CourseEntity::class);
    }
}