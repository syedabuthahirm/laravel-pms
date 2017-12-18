<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        $comments = Comment::where(['task_id'=>$task->id])->get();
        $newComment = new Comment();
        return view('comments.index', compact('task', 'comments', 'newComment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'body' => 'required'
        ]);

        $task->addComment($data);

        flash('Comment created successfully.');

        return redirect()->route('tasks.comments.index', $task->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, Comment $comment)
    {
        return view('comments.edit', compact('task', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Comment $comment)
    {
        $data = $request->validate([
            'body' => 'required'
        ]);

        $comment->update($data);

        flash('Comment updated successfully.');

        return redirect()->route('tasks.comments.index', $task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Comment $comment)
    {
        $comment->delete();
        flash('Comment deleted successfully.');
        return redirect()->route('tasks.comments.index', $task->id);
    }
}
