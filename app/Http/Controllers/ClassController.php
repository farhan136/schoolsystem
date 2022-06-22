<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Employee;
use App\Models\Schoolclass;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ClassController extends Controller
{

    public function index()
    {
        $data['PARENTTAG'] = "class";
        return view('admin.class.index', $data);
    }

    public function gridview()
    {
        // $class = Schoolclass::select(['id', 'name', 'teacher_id']);
        $class = DB::table('schoolclasses')
            ->join('employees', 'employees.id', '=', 'schoolclasses.teacher_id')
            ->select('schoolclasses.name as class_name', 'schoolclasses.id as class_id', 'employees.name as teacher_name')
            ->get();

        return Datatables::of($class)
            ->addColumn('class_action', function ($class) {
                return '<button  data-id="'.$class->class_id.'" id="tombol_edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</button>  <button  data-id="'.$class->class_id.'" id="tombol_hapus" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-delete"></i> Delete</button>';
            })->rawColumns(['class_action'])
            ->make();

    }

    public function create()
    {
        $Employee = Employee::all();
        return view('admin.class.create', ['employee'=>$Employee]);
    }

    public function store(Request $request)
    {
        // dd($store);
        $validated = $request->validate([ 
            'name' => 'required',
            'teacher' => 'required'
        ]);
        $class = new Schoolclass;
        $class->name = $request->name;
        $class->teacher_id = $request->teacher; 
        $class->created_at = date("Y-m-d H:i:s"); 
        $class->updated_at = date("Y-m-d H:i:s"); 
        $class->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function show($id)
    {
        //
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
}
