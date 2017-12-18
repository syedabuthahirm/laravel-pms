<div class="box">
    <form action="{{ route('tasks.comments.store',$task->id) }}" method="POST">
        @include('comments.form',['buttonText'=>'Create comment'])
    </form>
</div>