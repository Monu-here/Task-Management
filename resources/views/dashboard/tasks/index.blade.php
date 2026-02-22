<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Management - Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            position: fixed;
            width: 25%;
            left: 0;
            top: 0;
        }
        .sidebar .nav-link {
            color: #fff;
            margin-bottom: 10px;
            border-radius: 8px;
            padding: 10px 15px;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .main-content {
            margin-left: 25%;
            padding: 30px;
        }
        .header {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
            border-top: none;
            color: #667eea;
            font-weight: 600;
        }
        .btn-action {
            padding: 5px 10px;
            font-size: 0.85rem;
            margin: 0 3px;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-pending {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            color: white;
        }
        .status-completed {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-white mb-5">
            <h4>
                <i class="fas fa-tasks me-2"></i>Task Management
            </h4>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-chart-line me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="fas fa-users me-2"></i>Users
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link">
                <i class="fas fa-project-diagram me-2"></i>Projects
            </a>
            <a href="{{ route('admin.tasks.index') }}" class="nav-link active">
                <i class="fas fa-list-check me-2"></i>Tasks
            </a>
            <hr class="bg-light opacity-25">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" style="width: 75%;">
        <div class="header">
            <div>
                <h1>Tasks Management</h1>
                <p class="text-muted mb-0">Manage all tasks</p>
            </div>
            <button class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                <i class="fas fa-plus me-2"></i>Add Task
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Project</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>
                                <i class="fas fa-check-circle me-2" style="color: #667eea;"></i>
                                {{ $task->task_name }}
                            </td>
                            <td>{{ $task->projects ? $task->projects->name : 'N/A' }}</td>
                            <td>{{ Str::limit($task->description, 50) }}</td>
                            <td>
                                @if($task->status == 0)
                                    <span class="status-badge status-pending">Pending</span>
                                @else
                                    <span class="status-badge status-completed">Completed</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.tasks.update', $task->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="task_name" class="form-label">Task Name</label>
                                                <input type="text" class="form-control" name="task_name" value="{{ $task->task_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="project_id" class="form-label">Project</label>
                                                <select class="form-control" name="project_id" required>
                                                    @foreach($projects as $project)
                                                        <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                                            {{ $project->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3">{{ $task->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Pending</option>
                                                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No tasks found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Task Modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.tasks.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="task_name" class="form-label">Task Name</label>
                        <input type="text" class="form-control @error('task_name') is-invalid @enderror" name="task_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="project_id" class="form-label">Project</label>
                        <select class="form-control @error('project_id') is-invalid @enderror" name="project_id" required>
                            <option value="">-- Select Project --</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                            <option value="0">Pending</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
