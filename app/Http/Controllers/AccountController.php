<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function registration()
    {
        return view('front.account.registration');
    }

    // save user 
    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users, email',
            'password' => 'required|min:8|same:c_password',
            'c_password' => 'required',
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success', 'You have registered successfully');
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function login()
    {
        return view('front.account.login');
    }

    public function auhtenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
             if(Auth::attempt(['email' => $request->email, 'password'=> $request->password])){
                return redirect()->route('account.profile');
             }else{
                return redirect()->route('account.login')->with('error', "Email or Password is incorrect");
             }
        }else{
         return redirect()->route('account.login')
         ->withErrors($validator)
         ->withInput($request->only('email'));
        }
    }

    public function profile(){
        $id = Auth::user()->id;
        // dd($id);
        $user = User::where('id', $id)->first();
        // $user = User::find($id);
        return view('front.account.profile', ['user'=> $user]);

    }

    public function updateProfile(Request $request)
{
    $id = Auth::user()->id;
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3|max:15',
        'email' => 'required|email|unique:users,email,' . $id . ',id',
    ]);

    if ($validator->passes()) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->designation = $request->designation;
        $user->save();
        session()->flash('success', 'Profile updated successfully');
        return response()->json([
            'status' => true,
            'errors' => []
        ]);
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}

    public function logOut(){
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function updateProfilePic(Request $request){
        //  dd($request->all());
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'image'=> 'required|image'
        ]);

        if($validator->passes()){
             $image = $request->image;
             $ext = $image->getClientOriginalExtension();
             $imageName = $id.'-'.time().'.'.$ext;
             $image->move(public_path('/profile_pic/'), $imageName);
           
             session()->flash('success', 'Profile picture updated successfully');
             User::where('id', $id)->update(['image'=>$imageName]);
             return response()->json([
                'status'=>true,
                'image' => $imageName,
                'errors'=> []
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'errors'=> $validator->errors()
            ]);
        }
    }


    public function createJob(){
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
        return view('front.account.job.create', [
            'categories'=> $categories,
            'jobTypes'=> $jobTypes,
        ]);
    }

    public function saveJob(Request $request){
        $rules =[
            'title'=>'required|min:3|max:200',
            'category'=>'required',
            'jobType'=>'required',
            'vacancy'=>'required|integer',
            'salary'=>'required',
            'location'=>'required|max:50',
            'description'=>'required',
            'benefits'=>'required',
            'responsibility'=>'required',
            'qualifications'=>'required',
            'keywords'=>'required',
            'experience'=>'required',
            'company_name'=>'required|min:3|max:100',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator ->passes()){
            $job = new Job();
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->save();

            session()->flash('success', 'Job added successfully');
            return response()->json([
                'status' => true, 
                'errors' => [] ]);

        }else{
            return response()->json([
                'status'=>false,
                "errors"=>$validator->errors()
            ]);
        }
    }
 
    public function myJobs(){
return view('front.account.job.myJobs');
    }

}
