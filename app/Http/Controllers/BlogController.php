<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function create()
    {
        if (Auth::check()) {
            $categories = Category::get();
            return view('theme.blogs.create', compact('categories'));
        }
        abort(403);
    }

    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }
        $data['user_id'] = auth()->id();
        Blog::create($data);
        return back()->with('blogCreateStatus', 'Your blog created successfully');
    }

    public function show(Blog $blog)
    {
        return view('theme.single-blog', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            $categories = Category::get();
            return view('theme.blogs.edit', compact('categories', 'blog'));
        }
        abort(403);
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // image uploading 
                // 0- delete old image
                Storage::delete("public/blogs/$blog->image");
                // 1- get image
                $image = $request->image;
                // 2- change it's current name
                $newImageName = time() . '-' . $image->getClientOriginalName();
                // 3- move image to my project
                $image->storeAs('blogs', $newImageName, 'public');
                // 4- save new name to database record
                $data['image'] = $newImageName;
            }

            // create new blog record
            $blog->update($data);

            return back()->with('blogUpdateStatus', 'Your blog updated successfully');
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            Storage::delete("public/blogs/$blog->image");
            $blog->delete();
            return back()->with('blogDeleteStatus', 'Your blog has been deleted successfully');
        }
        abort(403);
    }

    /**
     * Display all user blogs.
     */
    public function myBlogs()
    {
        if (Auth::check()) {
            $blogs = Blog::where('user_id', Auth::user()->id)->paginate(10);
            return view('theme.blogs.my-blogs', compact('blogs'));
        }
        abort(403);
    }
}
