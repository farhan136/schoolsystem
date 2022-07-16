<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Employee;
use App\Models\Schoolclass;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['PARENTTAG'] = "employee";
        return view('admin.employee.index', $data);
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
        $employee = Employee::select(['id', 'name', 'photo', 'date_of_birth', 'phone_number', 'registration_number']);
        
        return Datatables::of($employee)
            ->addColumn('employee_action', function ($employee) {
                return '<button  data-id="'.$employee->id.'" id="tombol_edit" class="btn btn-xs btn-primary">Edit</button> <button  data-id="'.$employee->id.'" id="tombol_detail" class="btn btn-xs btn-warning"> Detail</button> <button  data-id="'.$employee->id.'" id="tombol_hapus" class="btn btn-xs btn-danger"> Delete</button>';
            })->editColumn('photo', function ($employee) {
                // return `<img  style="max-width:150px;" src="`. asset('picture/employee').'/'. $employee->photo;`">`;
                return "<img  style='max-width:90px;' src='". asset('picture/employee').'/'. $employee->photo."'>";
            })->editColumn('date_of_birth', function ($employee) {
                return $this->get_age($employee->date_of_birth);
            })->addIndexColumn()->rawColumns(['employee_action','photo'])->make();

    }

    public function create()
    {
        $Employee = Employee::all();
        $Cities = DB::table('cities')
            ->select('city_id', 'city_name')
            ->orderBy('city_name', 'asc')
            ->get();
        $Provinces = DB::table('provinces')
            ->select('prov_id', 'prov_name')
            ->orderBy('prov_id', 'asc')
            ->get();
        return view('admin.employee.create', ['employee'=>$Employee, 'cities'=>$Cities, 'provinces'=>$Provinces]);
    }

    public function store(Request $request)
    {
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('photo');
 
        // nama file
        $nama_foto = "employee".date('Ymdhis');

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'picture/employee';
 
        // upload file
        $file->move($tujuan_upload,$nama_foto);

        do {
            //get registration number and check unique
            $registration_number = '42443'.rand ( 10000 , 99999 );

            $cek_registrationnumber = Employee::where('registration_number', $registration_number)->first();

        } while (!empty($cek_registrationnumber));

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->registration_number = $registration_number ;
        $employee->email = $request->email;
        $employee->phone_number = $request->number;
        $employee->religion = "Islam";
        $employee->marital_status = $request->marital;
        $employee->gender = $request->gender;
        $employee->province = $request->province;
        $employee->city = $request->city;
        $employee->district = $request->district;
        $employee->subdistrict = $request->subdistrict; 
        $employee->photo = $nama_foto;
        $employee->place_of_birth = $request->placeofbirth;
        $employee->date_of_birth = $request->dateofbirth;
        $employee->address = $request->address;
        $employee->created_at = date("Y-m-d H:i:s"); 
        $employee->updated_at = date("Y-m-d H:i:s"); 
        $employee->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function edit($id, $detail ='')
    {
        $employee = Employee::select('id', 'name', 'photo', 'date_of_birth', 'phone_number', 'marital_status', 'photo', 'place_of_birth', 'address', 'registration_number', 'email', 'religion', 'province', 'city', 'district','subdistrict')->where('id', $id)->first();
        $Provinces = DB::table('provinces')
            ->select('prov_id', 'prov_name')
            ->orderBy('prov_id', 'asc')
            ->get();
        $Cities = DB::table('cities')
            ->select('city_id', 'city_name')
            ->orderBy('city_name', 'asc')
            ->get();
        $Cities2 = DB::table('cities')
            ->select('city_id', 'city_name')
            ->orderBy('city_id', 'asc')
            ->where('prov_id', $employee->province)
            ->get();
        $Districts = DB::table('districts')
            ->select('dis_id', 'dis_name')
            ->orderBy('dis_id', 'asc')
            ->where('city_id', $employee->city)
            ->get();
        $Subdistricts = DB::table('subdistricts')
            ->select('subdis_id', 'subdis_name')
            ->orderBy('subdis_id', 'asc')
            ->where('dis_id', $employee->district)
            ->get();
        $data['employee'] = $employee;
        $data['provinces'] = $Provinces;
        $data['cities'] = $Cities;
        $data['cities2'] = $Cities2;
        $data['districts'] = $Districts;
        $data['subdistricts'] = $Subdistricts;
        $data['disabled'] = '';
        $data['state'] = 'Edit';
        if ($detail != '') {
            $data['disabled'] = 'disabled';
            $data['state'] = 'Detail';
        }
        return view('admin.employee.edit',$data);
        
    }

    public function update(Request $request, $id, $isaktif = '')
    {
        $employee = Employee::find($id);
        if ($isaktif == 1) {
            $employee->email = $request->email;
            $employee->phone_number = $request->number;
            $employee->religion = "Islam";
            $employee->marital_status = $request->marital;
            $employee->gender = $request->gender;
            $employee->province = $request->province;
            $employee->city = $request->city;
            $employee->district = $request->district;
            $employee->subdistrict = $request->subdistrict; 
            $employee->place_of_birth = $request->placeofbirth;
            $employee->date_of_birth = $request->dateofbirth;
            $employee->address = $request->address;
            if (!empty($request->file('photo'))) {
                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('photo');
         
                // nama file
                $nama_foto = "employee".date('Ymdhis');

                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'picture/employee';
         
                // upload file
                $file->move($tujuan_upload,$nama_foto);

                //input ke database
                $employee->photo = $nama_foto;
            }
            $employee->updated_at = date("Y-m-d H:i:s"); 
        }else{
            $employee->updated_at = date("Y-m-d H:i:s");
            $employee->deleted_at = date("Y-m-d H:i:s");
        }
         
         
        $employee->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }



    public function destroy($id)
    {
        $employee = Employee::select('id')->where('id', '=', $id)->get();
        $data['employee'] = $employee[0];
        return view('admin.employee.deleteconfirm', $data);
    }

    
}
