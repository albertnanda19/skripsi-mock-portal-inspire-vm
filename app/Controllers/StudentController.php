<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\StudentService;
use App\Helpers\Response;
use \App\Repositories\UserRepository;

class StudentController extends BaseController
{
    protected $studentService;

    public function __construct()
    {
        $this->studentService = new StudentService(new UserRepository());
    }

    public function index()
    {
        //
    }

    public function students()
    {
        $students = $this->studentService->getStudentUsers();
        return Response::send(200, 'Success', $students);
    }
}