<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::orderBy('path')->select('id', 'text', 'level')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'parent_id' => 'required|integer',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->json_error($validator->errors()->all());
        }

        $comment = new Comment();
        $comment->parent_id = $request->get('parent_id');
        $comment->text = $request->get('text');


        $comment->save();

        if($comment->parent_id != 0) {
            $parent = Comment::find($comment->parent_id);
            $comment->path = $parent->path . '$'. $comment->id . '.';
            $comment->level = $parent->level + 1;
        }
        $comment->save();

        return $this->json_success($comment);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->json_error($validator->errors()->all());
        }

        $comment = Comment::find($id);

        if(!$comment)
            return $this->json_error('Wrong id');

        $comment->text = $request->get('text');
        $comment->save();

        return $this->json_success($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = Comment::find($id);

        if(!$comment)
            return $this->json_error('Wrong id');

        $comment->delete();

        return $this->json_success();

    }
}
