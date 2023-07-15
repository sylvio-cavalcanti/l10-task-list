<h1>The list of tasks</h1>
<br>
<div>
    {{-- First Alternative using if, else and foreach --}}
    @if (count($tasks))
        @foreach ($tasks as $task)
            <div>
                {{ $task->title }}
            </div>
        @endforeach
    @else
        <div>There are no tasks</div>
    @endif

    <br><br>
    
    {{-- Second Alternative using forelse which does the same thing --}}
    @forelse ($tasks as $task)
        <div>
            {{ $task->title }}
        </div>
    @empty
        <div>There are no tasks</div>
    @endforelse
</div>