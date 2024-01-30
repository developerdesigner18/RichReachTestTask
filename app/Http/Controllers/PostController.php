<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{

    public function home(){
        $posts = Post::with('user')->orderBy('created_at','DESC')->get();
        return view('post.home',compact('posts'));
    }

    public function index(Request $request){
        $data = Post::with('user')->where('user_id',Auth::user()->id)->get();
        if($request->ajax()){
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function ($row){
                    $action = '<ul class="list-inline mb-0 d-flex justify-content-center align-middle p-2">
                                    <li class="list-inline-item">
                                        <a class="text-warning editItem" href="javascript:void(0)" id="' . $row->id . '">
                                            <i class="ri-pencil-fill p-2 bg-soft-warning border border-warning rounded-circle"></i>
                                        </a>
                                    </li>
                                     <li class="list-inline-item">
                                        <a class="text-danger deleteItem" href="javascript:void(0)" id="' . $row->id . '">
                                            <i class="ri-delete-bin-line fs-16 p-2 bg-soft-danger border border-danger rounded-circle" data-id="1"></i>
                                        </a>
                                    </li>
                                </ul>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('post.index');
    }

    public function addPost(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(['status' => 0, 'message' => $validator->errors()->first()]);
        }

        try {
            $post = new Post();
            $post->user_id = Auth::user()->id;
            $post->title = $request->title;
            $post->content = $request->desc;
            $post->save();


            return response()->json(['status' => 1, 'message' => 'Post Added Successfully.']);
        }catch (\Exception $exception){
            return response()->json(['status' => 0, 'message' => $exception->getMessage()]);
        }
    }
    public function editPost(Request $request){
        $post = Post::find($request->id);
        $data = '<input type="hidden" name="id" value="' . $post->id . '">
                    <div class="col-lg-12">
                                   <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="teammembersName"
                                           placeholder="Enter name" name="title" value="' . $post->title . '">
                                </div>


                                <div class="mb-3">
                                    <label for="teammembersPass" class="form-label">Content</label>
                                    <textarea name="desc" id="" class="form-control" cols="10" rows="3">' . $post->content . '</textarea>
                                </div>
                            </div>
        ';
       return $data;
    }


    public function updatePost(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'id' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(['status' => 0, 'message' => $validator->errors()->first()]);
        }

        try {
            $post = Post::find($request->id);
            $post->title = $request->title;
            $post->content = $request->desc;
            $post->save();


            return response()->json(['status' => 1, 'message' => 'Post Updated Successfully.']);
        }catch (\Exception $exception){
            return response()->json(['status' => 0, 'message' => $exception->getMessage()]);
        }
    }

    public function deletePost(Request $request){

        try {
            Post::find($request->id)->delete();

            return response()->json(['status' => 1, 'message' => 'Post Delete!.']);
        }catch (\Exception $exception){
            return response()->json(['status' => 0, 'message' => $exception->getMessage()]);
        }
    }
}
