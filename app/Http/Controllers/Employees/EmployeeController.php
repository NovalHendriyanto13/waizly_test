<?php
namespace App\Http\Controllers\Employees;

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

use App\Models\Employee;
use App\Models\SalesEmployee;

class EmployeeController extends AppController {

    public function index(Request $request) {
        $res = Employee::when(!empty($request->department), function($query) use ($request) {
            return $query->whereIn('department', $request->department);
        })
            ->when(!empty($request->column), function($query) use ($request) {
                return $query->select($request->column);
            })
            ->get();
        return $this->successResponse($res);
    }

    public function create(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'job_title'=> 'required',
                'salary'=> 'required',
                'department' => 'required',
                'join_date'=> 'required'
            ],[],[]);

            if ($validator->fails()){
                throw new \Exception($validator->errors());
            }

            $save = Employee::firstOrCreate([
                'name' => $request->name,
                'job_title'=> $request->job_title,
                'salary'=> $request->salary,
                'department' => $request->department,
                'join_date'=> $request->join_date
            ]);

            return $this->successResponse($save);

        } catch (\Exception $e) {
            return $this->error404($e->getMessage());
        }
    }

    public function detail(Request $request, int $id) {
        try {
            $data = Employee::find($id);
            if (empty($data)) {
                throw new \Exception('No data found');
            }
            
            return $this->successResponse($data);

        } catch (\Exception $e) {
            return $this->error404($e->getMessage());
        }
    }

    public function update(Request $request, int $id) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'job_title'=> 'required',
                'salary'=> 'required',
                'department' => 'required',
                'join_date'=> 'required'
            ],[],[]);

            if ($validator->fails()){
                throw new \Exception($validator->errors());
            }

            $data = Employee::find($id);
            if (empty($data)) {
                throw new \Exception('No data found');
            }

            $data->name = $request->name;
            $data->job_title = $request->job_title;
            $data->salary = $request->salary;
            $data->department = $request->department;
            $data->join_date = $request->join_date;
            $data->save();

            return $this->successResponse($save);

        } catch (\Exception $e) {
            return $this->error404($e->getMessage());
        }
    }

    public function getCountJob(Request $request) {
        $jobTitle = $request->job_title;
        $res = Employee::where([
            'job_title' => $jobTitle
        ])->count();
        return $this->successResponse($res, 'Count Employee with Job Title');
    }

    public function getSummary(Request $request) {
        DB::statement(DB::raw('set @row:=0'));
        $data = Employee::select([
                DB::raw('SUM(sales_employee.sales) AS sales'), 
                'name',
                DB::raw('@row:=@row+1 as ranking')
            ])
            ->join('sales_employee', 'sales_employee.employee_id', 'employee.employee_id')
            ->groupBy('sales_employee.employee_id')
            ->orderBy(DB::raw('SUM(sales_employee.sales)'), 'desc')
            ->take(5)
            ->get();
        
        return $this->successResponse($data, 'Top 5 Employee Sales');
    }

    public function getAvgSalary(Request $request) {
        $last5Years = date('Y-m-d', strtotime('-5 years'));
        
        $data = Employee::where('join_date', '>=', $last5Years)
            ->avg('salary');
        
        return $this->successResponse($data, 'Average Salary last 5 year');
    }

    public function getAvgSalaryDepartment(Request $request) {
        $data = Employee::select([
            DB::raw('AVG(salary) AS avg_salary'), 
            'department'
        ])
        ->groupBy('department')
        ->get();

        $res = [];
        foreach($data as $dt) {
            $employee = Employee::select([
                'name', 'salary', 'department'
            ])
                ->where('salary', '>', $dt->avg_salary)
                ->where('department', $dt->department)
                ->get();

            if (!empty($employee)) {
                $res[] = $employee;
            }
        }
    
        return $this->successResponse($res, 'Employee more than average per department');   
    }
}