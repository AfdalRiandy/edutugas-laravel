<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    protected function validateTask(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'category' => 'nullable|string|max:255',
        ]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Task::query();

        if ($user->role === 'mahasiswa') {
            $query->where('is_completed', false);
        } elseif ($user->role === 'dosen') {
            $query->where('user_id', $user->id);
        }

        $tasks = $query->orderBy('due_date')->paginate(10);
        $categories = Task::select('category')->distinct()->pluck('category');

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);
        $this->validateTask($request);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'category' => $request->category,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dibuat!');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $submissions = $task->submissions()->with('user')->get();
        return view('tasks.show', compact('task', 'submissions'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $this->validateTask($request);

        $task->update($request->all());

        return redirect()->route('tasks.show', $task->id)
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }

    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return back()->with('success', 
            $task->is_completed ? 'Tugas ditandai selesai!' : 'Tugas ditandai belum selesai!'
        );
    }

    public function uploadSubmission(Request $request, Task $task)
    {
        $this->authorize('submit', $task);

        $request->validate([
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        $filePath = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Tugas berhasil diunggah!');
    }
}