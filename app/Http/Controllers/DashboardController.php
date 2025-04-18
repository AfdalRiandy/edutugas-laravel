<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'dosen') {
            $createdTasks = $user->tasks()->get();
            $tasksToReview = $user->tasks()->where('status', 'submitted')->get();

            return view('dashboard.dosen', compact('createdTasks', 'tasksToReview'));
        } elseif ($user->role === 'mahasiswa') {
            $upcomingTasks = $user->tasks()->upcoming()->get();
            $overdueTasks = $user->tasks()->overdue()->get();
            $completedTasks = $user->tasks()->completed()->take(5)->get();

            return view('dashboard.mahasiswa', compact('upcomingTasks', 'overdueTasks', 'completedTasks'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function dosen()
    {
        $user = Auth::user();
        
        if ($user->role !== 'dosen') {
            abort(403, 'Unauthorized action.');
        }
        
        $createdTasks = $user->tasks()->get();
        $tasksToReview = $user->tasks()->where('status', 'submitted')->get();

        return view('dashboard.dosen', compact('createdTasks', 'tasksToReview'));
    }

    public function mahasiswa()
    {
        return view('dashboard.mahasiswa'); // Create a view for mahasiswa dashboard
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }
}