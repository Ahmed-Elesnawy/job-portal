<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\DataTables\PostsDataTable;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Toastr;

class PostController extends Controller
{

    public function index(PostsDataTable $posts)
    {
        return $posts->render('dashboard.posts.index',['title' => trans('dashboard.posts')]);

    } // End of index fn 

    public function create()
    {
    	$tags       = Tag::select('id','name')->get();
    	return view('dashboard.posts.create',['title' => trans('dashboard.add_new_post')],[
    		'tags'       => $tags,
    	]);

    } // End of create fn


    public function store(PostRequest $request)
    {
    	

        $data = $request->except(['tags','slug']);
        
        $data['admin_id'] = auth_admin()->id;

        if ( $request->hasFile('image') )
        {
          $data['image'] = upload('image','posts',700,350);
        }


        $post = Post::create($data);

        $post->tags()->sync($request->tags);

        Toastr::success(trans('dashboard.success_added'));




        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.posts.edit',$post->id));
        }

        if ( $request->action == 'save-add' )
        {
            return back();
        }

        return redirect(route('dashboard.posts.index'));

    } // end of store fn


    public function edit(Post $post)
    {
        $tags       = Tag::select('id','name')->get();
        $title      = trans('dashboard.edit',['name' => $post->title]);
        return view('dashboard.posts.edit',compact('post','title','tags'));

    } // End of edit fn



    public function update(Post $post,PostRequest $request)
    {
        
        $data = $request->except(['tags','slug']);

        if ( $request->hasFile('image') )
        {
            $data['image'] = upload('image','posts',700,350,$post->image);
        }

        $post->update($data);

        $post->tags()->sync($request->tags);

        Toastr::success(trans('dashboard.success_update'));

        return back();

    } // End of update fn


    public function destroy(Post $post)
    {          
        $post->delete();

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.posts.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        
        Post::destroy(request('item'));
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.posts.index'));

    } // End Of destroyAll fn




}
