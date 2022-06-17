<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Employee;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function Paid(Request $request, $id)
    {
        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id',$id)->where('salary_month',$month)->first();
        
        if($check){
           return response()->json([
            'error'=>"salary already paid",
           ]);
        }
        else{

            $salary = new Salary();
            $salary->employee_id = $id;
            $salary->amount = $request->salary;
            $salary->salary_date = date('d/m/Y');
            $salary->salary_month = $month;
            $salary->salary_year = date('Y');
            $salary->save();
        
        }
       
    }
    public function allSalary()
    {
        $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }
    public function viewSalary($id)
    {
       $month = $id;
       $view = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name','salaries.*')
        ->where('salaries.salary_month',$month)
        ->get();
        return response()->json($view);
    }

    public function editsalary($id)
    {
        $view = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name','employees.email','salaries.*')
        ->where('salaries.id',$id)
        ->first();
        return response()->json($view);

    }
    public function updatesalary(Request $request,$id)
    {
        $month = $id;

        $date =array();
        $data['amount'] = $request->amount;
        $data['salary_month']= $request->salary_month;
        DB::table('salaries')->where('id',$id)->update($data);
    
    }
}
