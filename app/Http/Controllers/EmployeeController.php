<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'employees' => 'required|array',
            'employees.name' => 'required|string|max:255',
            'employees.lastname' => 'required|string|max:255',
            'employees.age' => 'required|integer|min:18',
            'employees.gender' => 'sometimes|string|in:male,female,other',
        ]);

        $employees = [];
        foreach ($request->employees as $employeeData) {
            $employee = Employee::create([
                'name' => $employeeData['name'],
                'lastname' => $employeeData['lastname'],
                'age' => $employeeData['age'],
                'gender' => $employeeData['gender'] ?? 'male',
            ]);
            $employees[] = $employee;
        }

        return response()->json([
            'message' => 'Employees created successfully',
            'count' => count($employees),
            'employees' => $employees,
        ], 201);
    }

    public function index()
    {
        $employees = Employee::all();
        
        return response()->json([
            'count' => $employees->count(),
            'employees' => $employees,
        ]);
    }

    public function getCategories()
    {
        $categories = [
            'Management' => 'Руководство',
            'Development' => 'Разработчик',
            'Design' => 'Дизайнер',
            'QA' => 'Тестировщик',
        ];

        return response()->json([
            'categories' => $categories,
            'count' => count($categories),
        ]);
    }

    public function getUsersWithGender()
    {
        $employees = Employee::all();
        $result = [];

        foreach ($employees as $employee) {
            $gender = ($employee->id % 2 == 0) ? 'женщина' : 'мужчина';
            
            $result[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'lastname' => $employee->lastname,
                'age' => $employee->age,
                'original_gender' => $employee->gender,
                'calculated_gender' => $gender,
                'is_even_id' => ($employee->id % 2 == 0),
            ];
        }

        return response()->json([
            'count' => count($result),
            'users' => $result,
        ]);
    }
}