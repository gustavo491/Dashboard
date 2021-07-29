<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DB::table('students')->paginate(5);

        return view('students', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = DB::table('courses')->get();
        return view('add-student', ['courses' => $courses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataInsert = array();
        if($_FILES){
            $dataInsert['student_photo'] = $_FILES["student_photo"]['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["student_photo"]["name"]);
            
            $check = getimagesize($_FILES["student_photo"]["tmp_name"]);
            if($check !== false) {
                if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["student_photo"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
            echo "File is not an image.";
            }
        }

        foreach($_POST as $key => $data){
            if($key != "_token")
                $dataInsert[$key] = $data;
        }
        DB::table('students')->insert($dataInsert);
        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses = DB::table('courses')->get();
        $student = DB::table('students')->where('id',$id)->first();
        $classes = DB::table('classes')->where('course_id',$student->course_id)->get();
        return view('edit-student', ['student' => $student, "courses" => $courses, "classes" => $classes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $dataInsert = array();
        if($_FILES){
            $dataInsert['student_photo'] = $_FILES["student_photo"]['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["student_photo"]["name"]);
            
            $check = getimagesize($_FILES["student_photo"]["tmp_name"]);
            if($check !== false) {
                if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["student_photo"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
            echo "File is not an image.";
            }
        }

        foreach($_POST as $key => $data){
            if($key != "_token" && $key != "student_id")
                $dataInsert[$key] = $data;
        }
        DB::table('students')->where('id',$_POST['student_id'])->update($dataInsert);
        
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('students')->delete($id);
        return redirect('/students');
    }

    /**
     * Return classes of course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listClasses(Request $request)
    {
        header('Content-type: application/json');
        $classes = DB::table('classes')->where('course_id', $_POST['course_id'])->get();

        $result = '<option value=""></option>';
        foreach($classes as $key => $data){
            $result .= "<option value='$data->id'>$data->name</option>";
        }
        return json_encode($result);
    }
}
