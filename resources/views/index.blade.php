<h1>The list of tasks</h1>
<br>
<div>
    {{-- Second Alternative using forelse which does the same thing --}}
    @forelse ($tasks as $task)
        <div style="margin-bottom: 8px;">
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks</div>
    @endforelse
</div>