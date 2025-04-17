<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FileController extends Controller
{
    use AuthorizesRequests;

    public function index(Task $task)
    {
        $this->authorize('view', $task);
        
        $files = $task->files; // Access the files relationship
        
        return view('files.index', compact('task', 'files'));
    }
    
    public function create(Task $task)
    {
        $this->authorize('update', $task);
        
        return view('files.create', compact('task'));
    }
    
    public function store(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $request->validate([
            'file' => 'required|file|max:10240', // max 10MB
        ]);
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('task_files', $fileName, 'public');
            
            File::create([
                'task_id' => $task->id,
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_type' => $file->getClientOriginalExtension(),
            ]);
            
            return redirect()->route('files.index', $task->id)
                ->with('success', 'File berhasil diunggah!');
        }
        
        return back()->with('error', 'Gagal mengunggah file!');
    }
    
    public function show(Task $task, File $file)
    {
        $this->authorize('view', $task);
        
        return Storage::download('public/' . $file->file_path, $file->file_name);
    }
    
    public function destroy(Task $task, File $file)
    {
        $this->authorize('update', $task);
        
        // Hapus file dari storage
        Storage::delete('public/' . $file->file_path);
        
        // Hapus dari database
        $file->delete();
        
        return redirect()->route('files.index', $task->id)
            ->with('success', 'File berhasil dihapus!');
    }
}