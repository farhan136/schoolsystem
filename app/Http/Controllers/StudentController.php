<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Student;
use App\Models\Schoolclass;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class StudentController extends Controller
{
    public function index()
    {
        $data['PARENTTAG'] = "student";
        return view('admin.student.index', $data);
    }

    public function get_age($date_of_birth)
    {
         $date = date_create($date_of_birth);
         $now = date_create(Date("Y-m-d"));
         $interval = date_diff($date,$now);
         return $interval->format('%y');
    }

    public function gridview()
    {
        $student = Student::select(['id', 'name', 'photo', 'date_of_birth', 'phone_number', 'registration_number'])->where('deleted_at', '=', NULL);
        
        return Datatables::of($student)
            ->addColumn('student_action', function ($student) {
                return '<button  data-id="'.$student->id.'" id="tombol_edit" class="btn btn-xs btn-primary">Edit</button> <button  data-id="'.$student->id.'" id="tombol_detail" class="btn btn-xs btn-warning"> Detail</button> <button  data-id="'.$student->id.'" id="tombol_hapus" class="btn btn-xs btn-danger"> Delete</button>';
            })->editColumn('photo', function ($student) {
                if ($student->photo == 'default.jpg') {
                    return "<img  style='max-width:90px;' src='". asset('picture/employee').'/'. $student->photo."'>";
                }else{
                    return "<img  style='max-width:90px;' src='". asset('picture/student').'/'. $student->photo."'>";
                }
            })->editColumn('date_of_birth', function ($student) {
                return $this->get_age($student->date_of_birth);
            })->addIndexColumn()->rawColumns(['student_action','photo'])->make();

    }

    public function create($id = '', $detail = '')
    {
        if ($id == '') {
            $Students = '';
            $Cities2 = '';
            $Districts = '';
            $Subdistricts = '';
            $State = 'Add';
            $data['disabled'] = '';
        }else{
            $Students = Student::find($id);
            $Cities2 = DB::table('cities')
            ->select('city_id', 'city_name')
            ->orderBy('city_id', 'asc')
            ->where('prov_id', $Students->province)
            ->get();
            $Districts = DB::table('districts')
                ->select('dis_id', 'dis_name')
                ->orderBy('dis_id', 'asc')
                ->where('city_id', $Students->city)
                ->get();
            $Subdistricts = DB::table('subdistricts')
                ->select('subdis_id', 'subdis_name')
                ->orderBy('subdis_id', 'asc')
                ->where('dis_id', $Students->district)
                ->get();
            $data['state'] = 'Edit';
        
        }
        $Classes = Schoolclass::select(['id', 'name'])->get();
        // dd($Classes);
        $Cities = DB::table('cities')
            ->select('city_id', 'city_name')
            ->orderBy('city_name', 'asc')
            ->get();
        $Provinces = DB::table('provinces')
            ->select('prov_id', 'prov_name')
            ->orderBy('prov_id', 'asc')
            ->get();
        $data = [
              'student'=>$Students, 
              'cities'=>$Cities, 
              'provinces'=>$Provinces,
              'classes'=>$Classes, 
              'cities2'=>$Cities2,
              'subdistricts'=>$Subdistricts,
              'districts'=>$Districts,
              'state' => $State,
              // 'disabled' => ''
        ];
        $data['disabled'] = '';
        if ($detail != '') {
            $data['disabled'] = 'disabled';
            $data['state'] = 'Detail';
        }
        return view('admin.student.form', $data);
    }

    public function store(Request $request,  $id='', $isaktif = '')
    {
        if($id == ''){
            $student = new Student;
            do {
                //get registration number and check unique
                $registration_number = '42443'.rand ( 10000 , 99999 );

                $cek_registrationnumber = Student::where('registration_number', $registration_number)->first();

            } while (!empty($cek_registrationnumber));
            $student->registration_number = $registration_number ;
            $student->created_at = date("Y-m-d H:i:s");    
        }else{
            $student = Student::find($id);
            if ($isaktif != 1) {
                $student->deleted_at = date("Y-m-d H:i:s");
                $student->updated_at = date("Y-m-d H:i:s");
                $student->save();

                echo "<script>window.opener.reloadDatatable();</script>";
                echo "<script>window.close();</script>";
            }
        }


        if (!empty($request->file('photo'))) {
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('photo');
         
            // nama file
            $nama_foto = "student".date('Ymdhis');

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'picture/student';
         
            // upload file
            $file->move($tujuan_upload,$nama_foto);

            //input ke database
            $student->photo = $nama_foto;
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone_number = $request->number;
        $student->class_id = $request->class;
        $student->religion = "Islam";
        $student->gender = $request->gender;
        $student->parent_id = 1;
        $student->province = $request->province;
        $student->city = $request->city;
        $student->district = $request->district;
        $student->subdistrict = $request->subdistrict; 
        $student->place_of_birth = $request->placeofbirth;
        $student->date_of_birth = $request->dateofbirth;
        $student->address = $request->address; 
        $student->updated_at = date("Y-m-d H:i:s");
        $student->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $student = Student::select('id')->where('id', '=', $id)->get();
        $data['student'] = $student[0];
        return view('admin.student.deleteconfirm', $data);
    }
}
