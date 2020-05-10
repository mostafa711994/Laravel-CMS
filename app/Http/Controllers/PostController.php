<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('VerifyCategoriesCount')->only(['create','store']);
    }

    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }


    public function create()
    {
        return view('posts.create')->with('categories' , Category::all())->with('tags',Tag::all());

    }


    public function store(CreatePostRequest $request)
    {
        $image = $request->image->store('posts');
       $post =  Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'contents'=>$request->contents,
            'published_at' => $request->published_at,
            'image' => $image,
            'category_id'=>$request->category,
            'user_id'=>auth()->user()->id


        ]);


            if($request->tags){

                $post->tags()->attach($request->tags);
            }



        session()->flash('success','Post created successfully');

        return redirect(route('posts.index'));
    }


    public function show(Post $post)
    {
        return view('blog.show')->with('post',$post);
    }


    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','description','contents','published_at','category']);


        if($request->hasFile('image')){

            $image = $request->image->store('posts');

            $post->deleteImage();

            $data['image'] = $image;
        }
        if($request->tags){
                $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success','Post updated successfully');

        return redirect(route('posts.index'));
    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed()){

           $post->deleteImage();

            $post->forceDelete();

            session()->flash('success','Post deleted successfully');

            return redirect(route('trashed-posts.index'));

        }
        else{
            $post->delete();

            session()->flash('success','Post trashed successfully');

            return redirect(route('posts.index'));
        }


    }


    public function trashed(Post $post){

        $trashed = Post::onlyTrashed()->get();

      return view('posts.index')->with('posts',$trashed);
    }



public function restore($id){

    $post = Post::withTrashed()->where('id',$id)->firstOrFail();
    $post->restore();

    session()->flash('success','Post restored successfully');

    return redirect()->back();
}


public function category(Category $category){

        return view('blog.category')->with('category',$category)
            ->with('posts',$category->posts()->searched()->simplePaginate(4))
            ->with('tags',Tag::all())
            ->with('categories',Category::all());


}

    public function tag(Tag $tag){

        return view('blog.tag')->with('tag',$tag)
            ->with('posts',$tag->posts()->searched()->simplePaginate(4))
                ->with('tags',Tag::all())
                ->with('categories',Category::all());


    }




}
