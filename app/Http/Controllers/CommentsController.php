<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;

class CommentsController extends Controller
{
    public function admin_index(){
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }
}
