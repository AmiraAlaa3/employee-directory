<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone_number' => 'required|string|max:11',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()],400);
        }

        $employee = Employee::create($validatedData->validated());

        return response()->json($employee,200);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'employee not found'],404);
        }
        $validatedData = Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:employees,email,' . $employee->id,
            'phone_number' => 'sometimes|string|max:20',
            'hire_date' => 'sometimes|date',
            'salary' => 'sometimes|numeric|min:0',
            'department_id' => 'sometimes|exists:departments,id',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()],400);
        }

        $employee->update($validatedData->validated());

        return response()->json($employee,200);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'employee not found'],404);
        }

        $employee->delete();

        return response()->json(['message' => 'employee deleted successfully'],200);
    }

    //  - Retrieve the **highest salary** across all employees, along with the employee's name, department, and hire date.
    public function getHighestSalary(){
        $highestSalary = Employee::select('first_name', 'last_name', 'department_id', 'hire_date')
        ->with('department')->orderBy('salary', 'desc')->first();
        return response()->json($highestSalary, 200);
    }


}
