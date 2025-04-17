<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'is_completed',
        'category',
        'status', // Add status to fillable attributes
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'is_completed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'collaborators', 'task_id', 'user_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
    
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }
    
    public function scopeIncomplete($query)
    {
        return $query->where('is_completed', false);
    }
    
    public function scopeUpcoming($query)
    {
        return $query->where('due_date', '>', now())->where('is_completed', false);
    }
    
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())->where('is_completed', false);
    }
}