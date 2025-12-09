<?php

namespace App\Http\Controllers\EmployeeController;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function store(Request $request)
    {

        $data = $request->validate([
        'employees' => ['required', 'array'],
        'employees.*.name' => ['required', 'string', 'max:255'],
        'employees.*.lastname' => ['required', 'string', 'max:255'],
        'employees.*.age' => ['required', 'integer', 'min:18']
    ]);

    

        $employee = Employee::query()->create($data);

        return response()->json([
            'data' => $employee,
            'message' => 'Employees created successfully',
        ], 201);
    }

    public function index()
    {
        $employees = Employee::query()->paginate(15);
        
        return response()->json([
            'count' => $employees->count(),
            'employees' => $employees,
        ],200);
    }

    public function getCategories()
    {
        $categories = [
            'Management' => [
                'id' => 1,
                'role' => 'Менеджер',
                'name' => 'Артем'],
            'Development' => [
                'id' => 2,
                'role' => 'Разработчик',
                'name' => 'Вадим'],
            'Design' => [
                'id' => 3,
                'role' => 'Дизайнер',
                'name' => 'Максим'],
            'QA' => [
                'id' => 4,
                'role' => 'Тестер',
                'name'=> 'Артем']
        ];

        return response()->json([
            'categories' => $categories,
            'count' => count($categories),
        ]);
    }

    public function getUsersWithGender()
    {
        $employees = Employee::query()->paginate(15);
   

        foreach ($employees as $employee) {
           $employee->gender = ($employee->id % 2 == 0) ? 'женщина' : 'мужчина';
            
        }

        return response()->json([
            'count' => count($employees),
            'users' => $employees,
        ]);
    }
}