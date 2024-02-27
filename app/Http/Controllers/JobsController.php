<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Category;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    public function index(Request $request){
       $categories =  Category::where('status', 1)->get();
       $jobTypes =  JobType::where('status', 1)->get();
       $jobs = Job::where('status',1);
       
       // Search using keyword
       if(!empty($request->keyword)){
        $jobs = $jobs->where(function($query) use($request){
            $query->orWhere('title', 'like', '%'.$request->keyword. '%');
            $query->orWhere('keywords', 'like', '%'.$request->keyword. '%');
        });
      }

      // search using location
      if(!empty($request->location)){
        $jobs = $jobs->where('location', $request->location);
      }
      // search using category
      if(!empty($request->category)){
        $jobs = $jobs->where('category_id', $request->category);
      }

      // search jobType
   $jobTypeArray =[];
      if(!empty($request->jobType)){
        $jobTypeArray = explode(',', $request->jobType);
        $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
      }

  // search using experience
  if(!empty($request->experience)){
    $jobs = $jobs->where('experience', $request->experience);
  }
     $jobs = $jobs->with('jobType', 'category');

     if (!empty($request->sort) && $request->sort == 1) {
        $jobs = $jobs->orderBy('created_at', 'DESC');
    } else {
        $jobs = $jobs->orderBy('created_at', 'ASC');
    }
    
    $jobs = $jobs->paginate(6);
     return view('front.jobs', [
        'categories' => $categories,
        'jobTypes' => $jobTypes,
        'jobs' => $jobs,
        'jobTypeArray'=>$jobTypeArray
     ]);
    }
  // job details
    public function detail($id){
          // echo $id;

          $job = Job::where(['id'=>$id, 'status'=>1])->with(['jobType', 'category'])->first();
          // dd($job);
          if($job == null){
            abort(404);
          }
          return view('front.jobDetail', ['job'=> $job]);
    }

    public function applyJob(Request $request){
             $id = $request->id;
             $job = Job::where('id', $id)->first();

             if($job == null){
              session()->flash('error', 'Job does not exist');
              return response()->json([
                'status'=>false,
                'message'=> 'Job does not exists'
              ]);
             }
             $employer_id = $job->user_id;
             if($employer_id == Auth::user()->id){
              session()->flash('error', 'You cannot apply this job');
              return response()->json([
                'status'=>false,
                'message'=> 'You cannot apply this job'
              ]);
             }
              
               $jobApplicationCount = JobApplication::where([
                'user_id'=> Auth::user()->id,
                'job_id'=> $id
               ])->count();

               if($jobApplicationCount>0){
                $message = 'You already applied this job';
                session()->flash('error', $message);
                return response()->json([
                  'status'=>false,
                  'message'=>$message
                ]);
               }

             $application = new JobApplication();
             $application->job_id = $id;
             $application->user_id = Auth::user()->id;
             $application->employer_id = $employer_id;
             $application->applied_date = now();
             $application->save();

             session()->flash('success', 'You have successfully applied');
              return response()->json([
                'status'=>true,
                'message'=> 'You have successfully applied'
              ]);
    }

}
