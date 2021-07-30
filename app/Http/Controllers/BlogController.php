<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id','DESC')->get();
        foreach ($blogs as $blog) {
            $blog['creator'] = User::find($blog->creator)->name;
            $blog['updator'] = User::find($blog->updator)->name;
        }
        return response()->json([
            'data' => $blogs
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'summary' => 'required',
            'pic' => 'required',
            'status' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Creating blog is failed',
                'errors' => $validator->errors()
            ], 200);
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->summary = $request->summary;
        $blog->status = $request->status;
        $blog->body = $request->body;
        $blog->creator = Auth::user()->id;
        $blog->updator = Auth::user()->id;
        if($request->hasFile('pic')) {
            $file_name = time().'_'.$request->file('pic')->getClientOriginalName();
            $file_path = $request->file('pic')->storeAs('blogs', $file_name, 'public');

            $blog->pic = time().'_'.$request->file('pic')->getClientOriginalName();
            $blog->path = '/storage/' . $file_path;   
        }

        $blog->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Blog created successfully.',
            'data' => $blog
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogs = Blog::find($id);
        $blogs['creator'] = User::find($blogs->creator)->name;
        $blogs['updator'] = User::find($blogs->updator)->name;
        $blogs['status'] = [
            'value' => $blogs->status,
            'label' => $blogs->status == 1 ? "Published": "Draft"
        ];
        return response()->json([
            'data' => $blogs
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'summary' => 'required',
            'status' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Updating blog is failed',
                'data' => $request->all(),
                'errors' => $validator->errors()
            ], 200);
        }

        $blog = Blog::find($request->id);
        $blog->title = $request->title;
        $blog->summary = $request->summary;
        $blog->status = $request->status;
        $blog->body = $request->body;
        $blog->updator = Auth::user()->id;
        if($request->hasFile('pic')) {
            $file_name = time().'_'.$request->file('pic')->getClientOriginalName();
            $file_path = $request->file('pic')->storeAs('blogs', $file_name, 'public');

            $blog->pic = time().'_'.$request->file('pic')->getClientOriginalName();
            $blog->path = '/storage/' . $file_path;   
        }

        $blog->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Blog updated successfully.',
            'data' => $blog
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();
        return response()->json([
            'status' => 'Success',
            'message' => 'Blog deleted successfully.'
        ], 200);
    }
}
