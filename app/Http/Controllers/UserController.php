<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPost;
use App\Models\Attachment;
use App\Models\Board;
use App\Models\District;
use App\Models\Division;
use App\Models\EducationQualification;
use App\Models\Exam;
use App\Models\Language;
use App\Models\MailingAddress;
use App\Models\Thana;
use App\Models\Training;
use App\Models\University;
use App\Models\User;
use App\Services\FileUpload;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    private $file;
    public function __construct(FileUpload $file)
    {
        $this->file = $file;
    }
    public function index()
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();
        $exams = Exam::all();
        $boards = Board::all();
        $univercities = University::all();
        return view('user.index', compact('divisions', 'districts', 'thanas', 'exams', 'boards', 'univercities'));
    }
    public function getAllDistrict(Request $request)
    {
        $division_id = $request->division_id;
        $districts = DB::table('districts')->where('division_id', $division_id)->get();
        return response()->json($districts);
    }

    public function getAllThana(Request $request)
    {
        $district_id = $request->district_id;
        $thanas = DB::table('thanas')->where('district_id', $district_id)->get();
        return response()->json($thanas);
    }

    public function store(UserPost $request)
    {
        // dd($request->toArray());
      
        // $request->validated();
       
        try {
            DB::transaction(function () use ($request) {

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = Hash::make('12345678');
                $user->address = $request->address;
                $user->save();
    
                //division and district and thana
                $mailing_address = new MailingAddress();
                $mailing_address->user_id = $user->id;
                $mailing_address->division_id = $request->division_id;
                $mailing_address->district_id = $request->district_id;
                $mailing_address->thana_id = $request->thana_id;
                $mailing_address->save();
    
                $language = [];
                foreach ($request->language as $key => $lang) {
                    $language[] = [
                        'user_id' => $user->id,
                        'language' => $lang,
                    ];
                }
                Language::insert($language);
    
                //education qualification
                $education_exam = [];
                foreach ($request->exam_id as $key => $exam) {
                    $education_exam[] = [
                        'user_id' => $user->id,
                        'exam_id' => $exam,
                        'board_id' => $request->board_id[$key],
                        'university_id' => $request->university_id[$key],
                        'result' => $request->result[$key],
                    ];
                }
                EducationQualification::insert($education_exam);
              
                //image amd cv
                $attachment = new Attachment();
                $attachment->user_id = $user->id;
                if ($request->has('image')) {
                    $image = $request->file('image');
                   
                        if ($image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'jpg') {
                            $reImage = $this->file->upload($request, 'image', 'Photo');
                            $attachment->image = $reImage;
                        }
                    
                }
                if ($request->has('cv')) {
                    $image = $request->file('cv');
                    if ($image->getClientOriginalExtension() == 'docx' || $image->getClientOriginalExtension() == 'pdf' || $image->getClientOriginalExtension() == 'doc') {
                        $reImage = $this->file->upload($request, 'cv', 'CV');
                        $attachment->cv = $reImage;
                    }
                }
             
                $attachment->save();
               
                
                $training =[];
                if (isset($request->training_name)) {
                    foreach ($request->training_name as $key => $tr_name) {
                        $training[] =[
                            'user_id' => $user->id,
                            'training_name' => $tr_name,
                            'training_details' =>  $request->training_details[$key],
                        ];
                    }
                    Training::insert($training);
                }
    
            });
    
            return back()->with('success', 'Data Submitted Successfully.');
        } catch (Exception $e) {
            return $e->getMessage();
        }
       
    }


    public function showRegistrationList()
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();
        return view('user.list', compact('divisions', 'districts', 'thanas'));

    }
    public function showRegistrationListAjax(Request $request)
    {

        $name = $request->name;
        $email = $request->email;

        $users = DB::table('mailing_addresses')
            ->join('users', 'users.id', 'mailing_addresses.user_id')
            ->join('divisions', 'divisions.id', 'mailing_addresses.division_id')
            ->join('districts', 'districts.id', 'mailing_addresses.district_id')
            ->join('thanas', 'thanas.id', 'mailing_addresses.thana_id')
            ->select('mailing_addresses.id as mailing_id', 'users.name as user_name', 'users.email as user_email', 'divisions.division_name as division', 'districts.district_name as district', 'thanas.thana_name as thana', 'mailing_addresses.created_at as insert_date')

            ->when($request->name, function ($query) use ($request, $name) {
            $get_users = [];
            $get_users = DB::table('users')
                ->where('name', 'like', '%' . $name . '%')
                ->pluck('id');
            return $query->whereIn('mailing_addresses.user_id', $get_users);
        })
            ->when($request->email, function ($query) use ($request, $email) {
            $get_email = [];
            $get_email = DB::table('users')
                ->where('email', $email)
                ->pluck('id');
            return $query->whereIn('mailing_addresses.user_id', $get_email);
        })
            ->when($request->division_id, function ($query) use ($request) {

            return $query->where('mailing_addresses.division_id', $request->division_id);
        })
            ->when($request->district_id, function ($query) use ($request) {
            return $query->where('mailing_addresses.district_id', $request->district_id);
        })
            ->when($request->thana_id, function ($query) use ($request) {
            return $query->where('mailing_addresses.thana_id', $request->thana_id);
        })

            ->get();

        $result = DataTables::of($users)

            ->addIndexColumn()

            ->addColumn('_user_name', function ($row) {
            return $row->user_name ?? '';
        })
            ->addColumn('_user_email', function ($row) {
            return $row->user_email ?? '';
        })
            ->addColumn('_division', function ($row) {
            return $row->division ?? '';
        })
            ->addColumn('_district', function ($row) {
            return $row->district ?? '';
        })
            ->addColumn('_thana', function ($row) {
            return $row->thana ?? '';
        })
            ->addColumn('_insert_date', function ($row) {
            return date('d-m-Y', strtotime($row->insert_date ?? ''));

        })
            ->addColumn('action', function ($row) {
            return '
                <a href="' . route('registration.edit', $row->mailing_id) . '" title="Edit" class="edit btn btn-primary">Edit</a>
                ';
        })
            ->rawColumns(['action'])

            ->make(true);


        return $result;

    }

    public function showRegistrationListEdit($id)
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();
        $mailing_address = MailingAddress::find($id);
        return view('user.edit', compact('mailing_address', 'divisions', 'districts', 'thanas'));

    }

    public function showRegistrationListUpdate(Request $request)
    {

        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',

        ]);

        MailingAddress::where('id', $request->mailing_address_id)
            ->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'thana_id' => $request->thana_id,
        ]);

        return back()->with('success', 'data updated successfully.');
    }

    public function getAllExam(){
        $exam = Exam::all();
        return response()->json($exam);
    }
    public function getAllBoard(){
        $board = Board::all();
        return response()->json($board);
    }
    public function getAllUniversity(){
        $university = University::all();
        return response()->json($university);
    }
}