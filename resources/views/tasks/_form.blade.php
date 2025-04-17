<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('title', $task?->title) }}" required>
    @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<!-- Due Date Field - Required Field -->
<div class="mb-4">
    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date <span class="text-red-500">*</span></label>
    <input type="datetime-local" name="due_date" id="due_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('due_date', $task?->due_date ? date('Y-m-d\TH:i', strtotime($task->due_date)) : '') }}" required>
    @error('due_date')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-1 text-xs text-gray-500">Select the deadline date and time for task submission</p>
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $task?->description) }}</textarea>
    @error('description')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="status" class="block mb-1 font-semibold">Status</label>
    <select name="status" id="status" class="border rounded px-3 py-2 w-full" required>
        <option value="pending" @selected(old('status', $task?->status) == 'pending')>Pending</option>
        <option value="in_progress" @selected(old('status', $task?->status) == 'in_progress')>In Progress</option>
        <option value="completed" @selected(old('status', $task?->status) == 'completed')>Completed</option>
    </select>
</div>
