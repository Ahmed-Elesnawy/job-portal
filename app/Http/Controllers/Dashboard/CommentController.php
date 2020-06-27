<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CommentsDataTable;
use App\Models\Comment;
use Toastr;

class CommentController extends Controller
{
    public function index(CommentsDataTable $comments)
    {
        return $comments->render('dashboard.comments.index',['title' => trans('dashboard.comments')]);

    } // End of index fn 

    public function create()
    {
    	return view('dashboard.comments.create',['title' => trans('dashboard.add_new_comment')]);

    } // End of create fn


    public function store(Request $request)
    {
    	
    	$request->validate([
    		'post_id' => ['required','numeric'],
    		'user_id' => ['required','numeric'],
    		'content' => ['required','string'],
    	]);

    	$data = $request->all();


        if ( $request->action == 'save' )
        {
            $comment = Comment::create($data);
            Toastr::success(trans('dashboard.success_added'));
            return redirect(route('dashboard.comments.index'));

        }  // End if
        else if ( $request->action == 'save-add' )
        {
            $comment = Comment::create($data);
            Toastr::success(trans('dashboard.success_added'));
            return back();

        } // End else if

        else if ( $request->action == 'save-edit' )         
        {
            $comment = Comment::create($data);
            Toastr::success(trans('dashboard.success_added'));
            return redirect(route('dashboard.comments.edit',$comment->id));

        } // End else if

    } // end of store fn


    public function edit(Comment $comment)
    {
        $title      = trans('dashboard.edit');
        return view('dashboard.comments.edit',compact('comment','title'));

    } // End of edit fn



    public function update(Comment $comment,Request $request)
    {
        $request->validate([

    		'post_id' => ['required','numeric'],
    		'user_id' => ['required','numeric'],
    		'content' => ['required','string'],
    	]);

        $data = $request->all();

       
        $comment->update($data);


        Toastr::success(trans('dashboard.success_update'));

        return back();

    } // End of update fn


    public function destroy(Comment $comment)
    {

          
        $comment->delete();

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.comments.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        
        Comment::destroy(request('item'));

        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.comments.index'));

    } // End Of destroyAll fn





    



}
