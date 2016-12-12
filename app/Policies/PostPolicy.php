<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;


class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function create_posts(User $user){
        return $user->role<=3;
    }
    public function edit_posts(User $user, Post $post){
        return $user->role<=3 && $user->id == $post->author_id;
    }
    public function delete_posts(User $user, Post $post){
        return $user->role<=3 && $user->id == $post->author_id;
    }
    public function view_posts(User $user){
        return $user->role<=3;
    }
    public function edit_others_posts(User $user){
        return $user->role<=2;
    }
    public function delete_others_posts(User $user){
        return $user->role<=2;
    }

    public function create_pages(User $user){
        return $user->role<=2;
    }
    public function edit_pages(User $user){
        return $user->role<=2;
    }
    public function delete_pages(User $user){
        return $user->role<=1;
    }
    public function view_pages(User $user){
        return $user->role<=3;
    }
}
