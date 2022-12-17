<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Employee;
use App\Models\Schoolclass;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{

    public function index()
    {
        $data['PARENTTAG'] = "class";
        return view('admin.class.index', $data);
    }

    public function gridview()
    {
        $class = DB::table('schoolclasses')
            ->join('employees', 'employees.id', '=', 'schoolclasses.teacher_id')
            ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id','schoolclasses.isaktif as class_status', 'employees.name as teacher_name')
            ->get();

        return Datatables::of($class)
            ->addColumn('class_action', function ($class) {
                return '<button  data-id="'.$class->class_id.'" id="tombol_edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</button>  <button  data-id="'.$class->class_id.'" id="tombol_hapus" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-delete"></i> Delete</button>';
            })->editColumn('class_status', function ($class) {
                if ($class->class_status == 1) {
                    return 'Active';
                }else{
                    return 'Not Active';
                }
            })->rawColumns(['class_action'])->make();
    }

    public function create()
    {
        $Employee = Employee::all();
        return view('admin.class.create', ['employee'=>$Employee]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'name' => 'required',
            'teacher' => 'required'
        ]);
        $class = new Schoolclass;
        $class->name = $request->name;
        $class->teacher_id = $request->teacher; 
        $class->created_at = date("Y-m-d H:i:s");
        $class->isaktif = 1; 
        $class->updated_at = date("Y-m-d H:i:s"); 
        $class->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function edit($id)
    {
        $employee = Employee::select('id', 'name')->get();
        $class = DB::table('schoolclasses')
            ->join('employees', 'employees.id', '=', 'schoolclasses.teacher_id')
            ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id', 'employees.id as teacher_id')
            ->where('schoolclasses.id', '=', $id)
            ->get();
        $data['employee'] = $employee;
        $data['class'] = $class[0];
        return view('admin.class.edit', $data);   
    }

    public function update(Request $request, $id, $isaktif = '')
    {
        $class = Schoolclass::find($id);
        if ($isaktif == 1) {
            $class->name = $request->name;
            $class->teacher_id = $request->teacher; 
        }
        $class->isaktif = $isaktif;
        $class->updated_at = date("Y-m-d H:i:s"); 
         
        $class->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function destroy($id)
    {
        $class = Schoolclass::select('id as class_id')->where('id', '=', $id)->get();
        $data['class'] = $class[0];
        return view('admin.class.deleteconfirm', $data);
    }

    public function checkuniqueteacher(Request $request){
        $class = Schoolclass::select('id')->where('teacher_id', '=', $request->id)->where('isaktif', '=', '1')->get();
        if (empty($class[0])) {
            $rtn = "unik";
        }else{
            $rtn = "tidak unik";
        }
        echo json_encode($rtn);
    }

    public function management($id = '')
    {
        $data['PARENTTAG'] = "class_management";
        $data['CHILDTAG'] = "class_management";
        $user = Auth::user();
        // dd($user->registration_number);
        
        // $teacher = Employee::select('registration_number', 'name', 'id')->where('id', 80)->get();
        
        $class = DB::table('employees')
            ->join('schoolclasses', 'schoolclasses.teacher_id', '=', 'employees.id')
            ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id', 'employees.name as teacher_name', 'employees.id as teacher_id')
            ->where('employees.registration_number', '=', $user->registration_number)
            ->get();

        $data['class'] = $class;
        return view('admin.class.management', $data);
    }

    public function gridviewstudents(Request $request)
    {
        $students = DB::table('students')
            ->leftjoin('schoolclasses', 'schoolclasses.id', '=', 'students.class_id')
            ->select('students.name', 'students.id as student_id')
            ->where('schoolclasses.id', '=', $request->class_id)
            ->get();

        return Datatables::of($students)
        ->addColumn('student_action', function ($item) {
                return '
                    <select class="form-control select2 student_absence_status" style="width: 100%;" name="student_absence_status[]" autocomplete="off" data-id = '.$item->student_id.'>
                      <option value="Hadir">Hadir</option>
                      <option value="Tidak Hadir">Tidak Hadir</option>
                    </select>
                    <br>
                    <select class="form-control select2" style="width: 100%;" name="student_absence_description[]" id="student_absence_description'.$item->student_id.'" autocomplete="off">
                      <option value="Tepat Waktu">Tepat Waktu</option>
                      <option value="Terlambat">Terlambat</option>
                      <option value="Izin Setengah Hari">Izin Setengah Hari</option>
                    </select>
                    <input type="hidden" name="id_student[]" value="'.$item->student_id.'">
                ';
            })->addIndexColumn()
        ->rawColumns(['student_action'])->make();
    }


    public function detail($id)
    {
        // $employee = Employee::select('id', 'name')->get();
        // $class = DB::table('schoolclasses')
        //     ->join('employees', 'employees.id', '=', 'schoolclasses.teacher_id')
        //     ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id', 'employees.id as teacher_id')
        //     ->where('schoolclasses.id', '=', $id)
        //     ->get();
        // $data['employee'] = $employee;
        $data['class'] = '';
        return view('admin.class.detail', $data);   
    }

    public function dailyreport($id = '')
    {
        $data['PARENTTAG'] = "class_management";
        $data['CHILDTAG'] = "daily_report";
        $user = Auth::user();

        $class = DB::table('employees')
            ->join('schoolclasses', 'schoolclasses.teacher_id', '=', 'employees.id')
            ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id', 'employees.name as teacher_name', 'employees.id as teacher_id')
            ->where('employees.registration_number', '=', $user->registration_number)
            ->get();

        $data['class'] = $class;
        return view('admin.class.dailyreport', $data);
    }

    public function absencestudents(Request $request)
    {   
        foreach($request->id_student as $key=>$val){
            $student = DB::table('students')
            ->select('registration_number')
            ->where('id', $val)
            ->get();

            DB::table('attendances')->insert([
                'registration_number' => $student[0]->registration_number,
                'date' =>  $request->date_absence,
                'is_present'=>$request->student_absence_status[$key],
                'description'=>$request->student_absence_description[$key],
                'created_at'=>date("Y-m-d H:i:s")
            ]);
        }
        return redirect('/class/dailyreport');
    }

    public function taskexam($id = '')
    {   
        $data['PARENTTAG'] = "class_management";
        $data['CHILDTAG'] = "taskexam";
        $user = Auth::user();
        
        $class = DB::table('employees')
            ->join('schoolclasses', 'schoolclasses.teacher_id', '=', 'employees.id')
            ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id', 'employees.name as teacher_name', 'employees.id as teacher_id')
            ->get();

        // $taskexams = DB::table('taskexams')
        //     ->leftjoin('question', 'taskexams.question_id', '=', 'questions.id')
        //     ->rightjoin('subjects', 'taskexams.subject_id', '=', 'subjects.id')
        //     ->rightjoin('schoolclasses', 'taskexams.class_id', '=', 'schoolclasses.id')
        //     ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id', 'employees.name as teacher_name', 'employees.id as teacher_id')
        //     ->get();

        $data['class'] = $class;
        return view('admin.class.taskexam', $data);
    }

    public function createtask($id = '')
    {   
        $subjects = DB::table('subjects')
            ->select('name', 'id')
            ->get();
        $classes = DB::table('schoolclasses')
            ->select('name', 'id')
            ->get();
        return view('admin.class.createtask', ['subjects'=>$subjects, 'classes'=>$classes]);
    }

    public function gridviewquestion(Request $request)
    {   
        $subject = $request->subject;
        $level = $request->level;
        $question = DB::table('questions')
            ->select('id', 'question','true_answer')
            ->where('subject_id', '=', $subject)
            ->where('level', '=', $level)
            ->get();

        return Datatables::of($question)
            ->addColumn('action', function ($question) {
                return '<input type="checkbox" class="form-control" name="question[]" value="'.$question->id.'">';
            })->rawColumns(['action'])->make();
    }


    public function storetask(Request $request)
    {
        return $request;

        DB::table('taskexams')->insert([
            'subject_id' => $request->subject,
            'class_id' => $request->class,
            'class_id' => $request->class,
            'start_date'=>$request->startdate,
            'end_date'=>$request->enddate,
        ]);

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }
}
