<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\District;
use App\Models\Division;
use App\Models\EducationQualification;
use App\Models\Exam;
use App\Models\Language;
use App\Models\Thana;
use App\Models\Training;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

    public function store(Request $request)
    {
        // dd($request->toArray());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'address' => 'nullable',
            'language.*' => 'required',
            'exam_id.*' => 'required',
            'board_id.*' => 'required',
            'university_id.*' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'cv' =>  'required|mimes:pdf,docs,doc',
            'training_name' => 'nullable',
            'training_details' => 'nullable',

        ]);

        DB::transaction(function () use ($request) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make('12345678');
            $user->address = $request->address;
            $user->save();

            foreach ($request->language as $key => $lang) {
                $language = new Language();
                $language->user_id = $user->id;
                $language->language = $lang;
                $language->save();
            }

            foreach ($request->exam_id as $key => $exam) {
                $education_qualification = new EducationQualification();
                $education_qualification->user_id = $user->id;
                $education_qualification->exam_id = $exam;
                $education_qualification->board_id = $request->board_id[$key];
                $education_qualification->university_id = $request->university_id[$key];
                $education_qualification->result = $request->result[$key];

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $reImage = time() . '.' . $image->getClientOriginalExtension();
                    if ($image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'jpg') {
                        $dest = public_path('/photo');
                        $image->move($dest, $reImage);
                        // save in database
                        $education_qualification->image = $reImage;
                    } else {
                        return back()->with('error', 'Please submit png or jpeg');
                    }
                }
                if ($request->has('cv')) {
                    $image = $request->file('cv');
                    $reImage = time() . '.' . $image->getClientOriginalExtension();
                    if ($image->getClientOriginalExtension() == 'docx' || $image->getClientOriginalExtension() == 'pdf' || $image->getClientOriginalExtension() == 'doc') {
                        $dest = public_path('/CV');
                        $image->move($dest, $reImage);

                        // save in database
                        $education_qualification->cv = $reImage;
                    } else {
                        return back()->with('error', 'Please submit docs or pdf');
                    }
                }
                $education_qualification->save();
            }

            if (isset($request->training_name)) {
                foreach ($request->training_name as $key => $tr_name) {
                    $training = new Training();
                    $training->user_id = $user->id;
                    $training->training_name = $tr_name;
                    $training->training_details = $request->training_details[$key];
                    $training->save();
                }
            }
           
        });

        return back()->with('success', 'Data Submitted Successfully.');
    }
}
