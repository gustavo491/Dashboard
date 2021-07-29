<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
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
        $courses = DB::table('courses')->paginate(5);
        return view('courses', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-course');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('courses')->insert(['name' => $_POST['name']]);
        return redirect('/courses');
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
        $course = DB::table('courses')->where('id',$id)->first();
        return view('edit-course', ['course' => $course]);
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
        $data = ['name' => $_POST['name']];
        DB::table('courses')->where('id',$_POST['course_id'])->update($data);
        
        return redirect('/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        DB::table('courses')->delete($id);
        return redirect('/courses');
    }

    /**
     * View courses XML.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewXML()
    {   
        return view('courses-xml');
    }

    /**
     * Import courses of XML.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function importXML()
    {   
        $dataInsert['xml'] = $_FILES["xml"]['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["xml"]["name"]);
        
            if (move_uploaded_file($_FILES["xml"]["tmp_name"], $target_file)) {
                //echo "The file ". htmlspecialchars( basename( $_FILES["xml"]["name"])). " has been uploaded.";
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        $xml = simplexml_load_file('uploads/'.$_FILES['xml']['name']);
        
        $courses = DB::table('courses')->get();
        $existe = 0;
        foreach($xml->curso as $key => $data){
            
            foreach($courses as $chave => $dados ){
                if($dados['name'] == $data['nome']){
                    $existe = 1;
                }
            }
            if(!$existe)
                DB::table('courses')->insert(['name' => $data->nome]);
            $existe = 0;
        }
       // DB::table('courses')->insert();
        return redirect('/courses');
    }
}
