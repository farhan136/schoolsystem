<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class SubjectController extends Controller
{
    public function index()
    {
        $data['PARENTTAG'] = "subject";
        $data['CHILDTAG'] = "subject";
        return view('admin.subjects.index', $data);
    }

    public function gridview()
    {
        $subject = Subject::select(['id', 'name', 'code'])->get();
        
        return Datatables::of($subject)
            ->addColumn('subject_action', function ($subject) {
                return '<button  data-id="'.$subject->id.'" id="tombol_edit" class="btn btn-xs btn-primary">Edit</button><button  data-id="'.$subject->id.'" id="tombol_hapus" class="btn btn-xs btn-danger"> Delete</button>';
            })->addIndexColumn()->rawColumns(['subject_action'])->make();

    }

    public function create($id = '')
    {
        if ($id == '') {
            $Subjects = '';
            $State = 'Add';
        }else{
            $Subjects = Subject::find($id);
            $State = 'Edit';
        
        }
        $data = [
              'subject'=>$Subjects, 
              'state' => $State,
        ];
        return view('admin.subjects.form', $data); 
    }

    public function store(Request $request,  $id='', $isaktif = '')
    {
        if($id == ''){
            $subject = new Subject;
            $subject->created_at = date("Y-m-d H:i:s");    
        }else{
            $subject = Subject::find($id);
            if ($isaktif != 1) {
                $subject->delete();

                echo "<script>window.opener.reloadDatatable();</script>";
                echo "<script>window.close();</script>";
            }
        }

        $subject->name = strtoupper($request->name);
        $subject->code = $request->code;
        $subject->updated_at = date("Y-m-d H:i:s");
        $subject->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function destroy($id)
    {
        $subject = Subject::find(1);
 
        $subject->delete();
    }

    public function bank()
    {
        $data['PARENTTAG'] = "subject";
        $data['CHILDTAG'] = "bank";
        $subject = Subject::select(['id', 'name', 'code'])->get();
        $data = [
              'subject'=>$subject, 
        ];
        return view('admin.subjects.bank', $data);
    }
}
