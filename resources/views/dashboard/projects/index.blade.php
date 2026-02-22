<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Management - Task Management</title>
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
        .project-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }
        .project-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        .btn-action {
            padding: 5px 10px;
            font-size: 0.85rem;
            margin: 0 3px;
        }
        .color-preview {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
            border: 2px solid #e9ecef;
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
            <a href="{{ route('admin.projects.index') }}" class="nav-link active">
                <i class="fas fa-project-diagram me-2"></i>Projects
            </a>
            <a href="{{ route('admin.tasks.index') }}" class="nav-link">
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
                <h1>Projects Management</h1>
                <p class="text-muted mb-0">Manage all projects</p>
            </div>
            <button class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                <i class="fas fa-plus me-2"></i>Add Project
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @forelse($projects as $project)
            <div class="project-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                            <div class="color-preview" style="background-color: {{ $project->color_code ?? '#667eea' }};"></div>
                            <h5 class="mb-0">{{ $project->name }}</h5>
                        </div>
                        <p class="text-muted mb-0"><strong>Color Code:</strong> {{ $project->color_code ?? 'N/A' }}</p>
                        <p class="text-muted mb-0"><strong>Company:</strong> {{ $project->company->company_name ?? ''}}</p>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editProjectModal{{ $project->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-action">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.projects.update', $project->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $project->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="color_code" class="form-label">Color Code</label>
                                    <input type="color" class="form-control form-control-color" name="color_code" value="{{ $project->color_code ?? '#667eea' }}" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-5">
                <i class="fas fa-inbox fa-3x mb-3" style="opacity: 0.5;"></i>
                <p>No projects found. Create one to get started.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Create Project Modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.projects.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Project Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="color_code" class="form-label">Color Code</label>
                        <input type="color" class="form-control form-control-color @error('color_code') is-invalid @enderror" name="color_code" value="#667eea" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
