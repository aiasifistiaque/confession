<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Confession;
use App\Comment;
use App\Reply;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;


class PagesController extends Controller
{
    public function homePage(){
        return view('pages.index');
    }
    
    public function postPage(){
        return view('pages.postasecret');
    }

    public function readSecret(){
        $count=Confession::count();
        $random=rand(1,$count);
        $query=Confession::find($random);
        $confession=$query->confession;
        $posted_on=$query->created_at;
        $views=$query->views;
        $id=$query->id;
        $query->views=$views+1;
        $query->save();
        return view('pages.readsecret',['confession'=>$confession,'posted_on'=>$posted_on,'views'=>$views,'confession_id'=>$id]);
    }

    public function readPost($id){
        
        $query=Confession::find($id);
        $confession=$query->confession;
        $posted_on=$query->created_at;
        $views=$query->views;
        $query->views=$views+1;
        $views=$query->views;
        $query->save();
        return view('pages.readsecret',['confession'=>$confession,'posted_on'=>$posted_on,'views'=>$views,'confession_id'=>$id]);
    }
    
    public function postSecret(Request $request){
        $confession=$request->confession;
        echo 'hello';
        $newconfession=new Confession;
        $newconfession->confession=$confession;
        $newconfession->views=0;
        echo('confession');
        $newconfession->save();
        $query=Confession::where('confession',$confession)->get();
        foreach($query as $val){
            $id=$val->id;
        }
        
        return redirect('/read/'.$id);

    }
    public function getComments($id){
        $query=Comment::where('confession_id', $id)->get();
        return response()->json(['data'=>$query]);

    }

    public function showReplies($id){
        $query=Reply::where('comment_id', $id)->get();
        return response()->json(['data'=>$query]);
    }

    public function getAllConfessions(){
        $query=Confession::all();
        return response()->json(['data'=>$query]);

    }

    public function postComments(Request $request){
        $id=$request->id;
       
        $com=$request->comment;
        $id=$request->id;
        $name=$request->name;

        $newcomment = new Comment;
        $newcomment->comment=$com;
        $newcomment->confession_id=$id;
        $newcomment->user_name=$name;
        $newcomment->replies=0;
        $newcomment->save();

        
        $query=Comment::where('confession_id',$id)->get();
        return response()->json(['data'=>$query]);

    }

    public function postReplies(Request $request){
        $id=$request->id;
       
        $id=$request->id;
        $name=$request->name;
        $reply=$request->reply;

        $newreply = new Reply;
        $newreply->reply=$reply;
        $newreply->comment_id=$id;
        $newreply->user_name=$name;
        $newreply->save();

        $com=Comment::find($id);
        $replies=$com->replies;
        $com->replies=$replies+1;
        $com->save();

        return response()->json(['status'=>200]);

    }
}
