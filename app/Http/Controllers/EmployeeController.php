<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function adminIndex(Request $request)
    {
        $employees = DB::table('employees')
                       ->orderBy('employee_id', 'DESC')
                       ->paginate(5);
        return view('employees.admin.index', compact('employees'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function adminCreate()
    {
        return view('employees.admin.create');
    }

    public function adminStore()
    {
        Employee::create($this->validateRequest());
        return redirect(route('admin.employee.index'));
    }

    public function adminEdit(int $employeeId)
    {
        $employee = Employee::where('employee_id', '=', $employeeId)->firstOrFail();
        return view('employees.admin.edit', compact('employee'));
    }

    public function adminUpdate(Request $request, int $employeeId)
    {
        $employee = Employee::where('employee_id', '=', $employeeId)->firstOrFail();
        $employee->update($this->validateRequest());

        return redirect(route('admin.employee.index'));
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'employee_name' => ['required', 'sometimes'],
            'employee_surname' => ['required', 'sometimes', ],
            'employee_birthday' => ['required', 'sometimes', 'date_format:Y-m-d'],
            'employee_address' => ['required', 'sometimes'],
            'employee_phone_number' => ['required', 'sometimes'],
            'employee_identification_code' => ['required', 'sometimes', 'numeric', 'unique:employees,employee_identification_code,'.request()->id.',employee_id', 'gt:0', 'digits:4'],
        ]);
    }
}
