<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Category;
use Illuminate\Http\Request;

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

}
