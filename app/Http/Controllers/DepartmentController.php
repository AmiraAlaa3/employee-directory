<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Cache::remember('departments', 600, function () {
            return Department::all();
        });

        return response()->json($departments);
    }

    public function employees($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }

        $employees = $department->employees;

        if ($employees->isEmpty()) {
            return response()->json(['message' => 'This department does not have any employees'], 200);
        }

        return response()->json($employees, 200);
    }

    /*
       - **Count Employees by Department**: `GET /api/departments/employees/count`
       - Retrieve the **total number of employees** in each department, ordered by department name.
       - **Cache the Employee Count by Department** (`GET /api/departments/employees/count`) with a 5-minute expiration
    */

    public function employeeCount()
    {
        $count = Cache::remember('total_employee_by_department', 300, function () {
            return Department::withCount('employees')->orderBy('name')->get();
        });

        return response()->json($count, 200);
    }

    // - Calculate and return the **average salary** for each department.
    public function averageSalary()
    {
        $averageSalary = Department::with('employees')->get()->map(function ($department) {
            return [
                'department' => $department->name,
                'average_salary' => $department->employees->avg('salary')
            ];
        });

        return response()->json($averageSalary, 200);
    }
}
