<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CollaborationInvite;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CollaboratorController extends Controller
{
    use AuthorizesRequests;
    public function index(Task $task)
    {
        $this->authorize('manageCollaborators', $task);
        
        $collaborators = $task->collaborators;
        
        return view('collaborators.index', compact('task', 'collaborators'));
    }
    
    public function create(Task $task)
    {
        $this->authorize('manageCollaborators', $task);
        
        return view('collaborators.create', compact('task'));
    }
    
    public function store(Request $request, Task $task)
    {
        $this->authorize('manageCollaborators', $task);
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        // Cek apakah user adalah pemilik tugas
        if ($user->id === $task->user_id) {
            return back()->with('error', 'Pemilik tugas tidak bisa menjadi kolaborator!');
        }
        
        // Cek apakah user sudah menjadi kolaborator
        $existingCollaborator = Collaborator::where('task_id', $task->id)
                              ->where('user_id', $user->id)
                              ->first();
                              
        if ($existingCollaborator) {
            return back()->with('error', 'User sudah menjadi kolaborator pada tugas ini!');
        }
        
        // Tambahkan collaborator
        Collaborator::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
        ]);
        
        // Kirim email notifikasi (opsional)
        // Mail::to($user->email)->send(new CollaborationInvite($task));
        
        return redirect()->route('collaborators.index', $task->id)
                ->with('success', 'Kolaborator berhasil ditambahkan!');
    }
    
    public function destroy(Task $task, User $user)
    {
        $this->authorize('manageCollaborators', $task);
        
        Collaborator::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->delete();
            
        return redirect()->route('collaborators.index', $task->id)
                ->with('success', 'Kolaborator berhasil dihapus!');
    }
}