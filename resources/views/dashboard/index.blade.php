<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Task Management</title>
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
            padding: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .header {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            color: #333;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 sidebar">
            <div class="text-white mb-5">
                <h4>
                    <i class="fas fa-tasks me-2"></i>Task Management
                </h4>
            </div>
             <nav class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="fas fa-chart-line me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="fas fa-users me-2"></i>Users
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link ">
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

        <div class="col-md-9 main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <p class="text-muted">Welcome back! Here's your system overview.</p>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <i class="fas fa-users fa-2x" style="color: #667eea; opacity: 0.5;"></i>
                        <div class="stat-number">{{ $totalUsers }}</div>
                        <div class="stat-label">Total Users</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <i class="fas fa-project-diagram fa-2x" style="color: #667eea; opacity: 0.5;"></i>
                        <div class="stat-number">{{ $totalProjects }}</div>
                        <div class="stat-label">Total Projects</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <i class="fas fa-tasks fa-2x" style="color: #764ba2; opacity: 0.5;"></i>
                        <div class="stat-number">{{ $totalTasks }}</div>
                        <div class="stat-label">Total Tasks</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
