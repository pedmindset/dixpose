<?php

class Post extends Eloquent
{
    public function tags()
    {
        return $this->belongsToMany('Tag');
    }
}

class Tag extends Eloquent
{
    public function posts()
    {
        return $this->belongsToMany('Post');
    }
}

class PostController extends BaseController
{
    public function addPost()
    {
        // assume it won't work
        $success = false;

        DB::beginTransaction();

        try {
            $post = new Post;

            // maybe some validation here...

            $post->title = Input::get('post_title');
            $post->content = Input::get('post_content');

            if ($post->save()) {
                $tag_ids = Input::get('tags');
                $post->tags()->sync($tag_ids);
                $success = true;
            }
        } catch (\Exception $e) {
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if ($success) {
            DB::commit();
            return Redirect::back()->withSuccessMessage('Post saved');
        } else {
            DB::rollback();
            return Redirect::back()->withErrorMessage('Something went wrong');
        }
    }
}