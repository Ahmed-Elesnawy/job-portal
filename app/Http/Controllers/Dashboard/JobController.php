<?php



namespace App\Http\Controllers\Dashboard;

use Toastr;
use Storage;
use App\Models\Job;
use App\Models\Tag;
use App\Models\Skill;
use Illuminate\Support\Str;
use App\DataTables\JobsDataTable;
use  App\Http\Requests\JobRequest;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index(JobsDataTable $jobs)
    {
        return $jobs->render('dashboard.jobs.index',['title' => trans('dashboard.jobs')]);

    } // End of index fn 

    public function create()
    {
    	 
    	return view('dashboard.jobs.create',
        [
            'title'      => trans('dashboard.add_new_job'),
    		'tags'       => Tag::select('id','name')->get(),
    		'skills'     => Skill::select('id','name')->get()
    	]);

    } // End of create fn


    public function store(JobRequest $request,JobService $service)
    {

    	$data = $request->except(['tags','skills','banner']);


    	if ( $request->hasFile('banner') )
    	{
    		$data['banner'] = upload('banner','jobs',82,82);
    	}

        $job = Job::create($data);

        $job->skills()->sync($request->skills);
        $job->tags()->sync($request->tags);


        Toastr::success(trans('success_added'));

        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.jobs.edit',$job->id));
        }

        if ( $request->action == 'save-add' )
        {
            return back();
        }

        return redirect(route('dashboard.jobs.index'));


    	
       

    } // end of store fn


    public function edit(Job $job)
    {

        return view('dashboard.jobs.edit',
        [
            'job'        => $job,
            'title'      => trans('dashboard.edit',['name' => $job->title]),
            'tags'       => Tag::select('id','name')->get(),
            'skills'     => Skill::select('id','name')->get()
        ]);

    } // End of edit fn



    public function update(Job $job,JobRequest $request)
    {
        
        $data = $request->except(['tags','skills','banner']);

        if ( $request->hasFile('banner') )
        {
            $data['banner'] = upload('banner','jobs',82,82,$job->banner);
        }

        $job->update($data);

        $job->skills()->sync($request->skills);
        $job->tags()->sync($request->tags);

        return back();

    } // End of update fn


    public function destroy(Job $job)
    {
        $job->delete();
        Toastr::success(trans('success_delete'));
        return redirect(route('dashboard.jobs.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        Job::destroy(request('item'));
        Toastr::success(trans('success_delete'));
        return redirect(route('dashboard.jobs.index'));

    } // End Of destroyAll fn
    

    public function dublicate(Job $job)
    {
        $new_job = $job->replicate(['banner']);
        $new_job->title = $this->title . '-(dublicated)';
        $new_job->slug = Str::slug($new_job->title);
        $new_job->push();

        foreach ( $job->skills as $skill )
        {
            $new_job->skills()->attach($skill);
        }

        foreach ( $job->tags as $tag )
        {
            $new_job->tags()->attach($tag);
        }

        Toastr::success('Record Copied Successfully!');
        return redirect(route('dashboard.jobs.edit',$new_job->id));
    }

    

   

}
