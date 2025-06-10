<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System - Monu Kumar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background: linear-gradient(135deg, #9ba7db 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 50px;
        }

        .main-container {
            margin: 20px;
            min-height: 90vh;
        }



        .content-row {
            padding: 0 20px;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: rgb(245, 245, 245);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-danger-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(245, 101, 101, 0.4);
        }

        .form-select,
        .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .filter-section {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .task-item {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .task-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .project-item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .project-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .status-badge {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }



        .btn-group-custom {
            gap: 10px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-sm-custom {
            padding: 5px 10px;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
                border-radius: 15px;
            }

            .content-row {
                padding: 0 10px;
            }

            .section-card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    @php
        $projects = DB::table('projects')->get();
    @endphp
    <div class="container-fluid">
        <div class="main-container">
            <div class="row content-row">
                <div class="col-lg-8 col-md-12">
                    <div class="section-card">
                        <div class="section-title">
                            <span><i class="fas fa-tasks me-2"></i>Tasks</span>
                            <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#taskAdd">
                                <i class="fas fa-plus me-1"></i> Add New Task
                            </button>
                        </div>
                        <div class="filter-section">
                            <form action="{{ route('filterData') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Project</label>
                                        <select name="project_id" id="project_id" class="form-control">
                                            <option value="" selected disabled>Select Project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected disabled>Select Project</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <div class="btn-group-custom d-flex w-100">
                                            <button class="btn btn-primary-custom flex-fill">
                                                <i class="fas fa-filter me-1"></i> Filter Tasks
                                            </button>
                                            <a href="{{ route('home') }}">
                                                <button class="btn btn-danger-custom flex-fill">
                                                    <i class="fas fa-times me-1"></i> Reset Filter
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if ($tasks->isNotEmpty())
                            @foreach ($tasks as $task)
                                @if ($task->status == 0 || $task->status == 1)
                                    <div class="task-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1"
                                                @if (!$task->status == 0) style="text-decoration: line-through;" @endif>
                                                <h6 class="fw-bold text-primary mb-2">{{ $task->task_name }}</h6>
                                                <p class="text-muted mb-2">
                                                    <strong>Project Name:</strong>
                                                    <span class="text-primary">{{ $task->projects->name }}</span>
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <strong>Description:</strong> <span
                                                        class="text-primary">{{ $task->description }}</span>
                                                </p>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if ($task->status == 0)
                                                        <span class="status-badge"
                                                            style="background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#taskStatusUpdate{{ $task->id }}">
                                                            <i class="fas fa-edit me-1"></i> Pending
                                                        </span>
                                                    @elseif ($task->status == 1)
                                                        <span class="status-badge"
                                                            style="background: linear-gradient(135deg, #43dd06 0%, #43dd06 100%);">
                                                            Completed
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="action-buttons">
                                                <button class="btn btn-outline-primary btn-sm-custom"
                                                    @if (!$task->status == 0) disabled @endif
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#taskupdate{{ $task->id }}">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </button>
                                                <a href="{{ route('task.delete', ['uuid' => $task->uuid]) }}">
                                                    <button
                                                        onclick="return confirm('Are you want to delete this task');"
                                                        class="btn btn-outline-danger btn-sm-custom"
                                                        @if (!$task->status == 0) disabled @endif>
                                                        <i class="fas fa-trash me-1"></i>
                                                        Delete
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @include('task.task-status-edit')
                            @endforeach
                        @else
                            <div class="text-center text-muted">No Task are created.</div>

                        @endif

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="section-card">
                        <div class="section-title">
                            <span><i class="fas fa-folder-open me-2"></i>Projects</span>
                            <button class="btn btn-primary-custom" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fas fa-plus me-1"></i> Add New Project
                            </button>


                        </div>

                        @if ($projects->isNotEmpty())
                            @foreach ($projects as $project)
                                <div class="project-item"
                                    style="background: linear-gradient(135deg, {{ $project->color_code }} 0%, #000  100%);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1 fw-bold">{{ $project->name }}</h6>
                                        </div>
                                        <div class="action-buttons">
                                            <button class="btn btn-light btn-sm-custom" data-bs-toggle="modal"
                                                data-bs-target="#projectUpdate{{ $project->id }}"
                                                style="color:{{ $project->color_code }} ">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="{{ route('project.delete', ['uuid' => $project->uuid]) }}">
                                                <button class="btn btn-light btn-sm-custom text-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @include('project.project-edit')
                            @endforeach
                        @else
                            <div class="text-center text-muted">No projects.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{project model open }} --}}
    @include('project.project-add')
    {{-- {{Project Model close}} --}}
    @include('task.task-add')
    @include('task.task-edit')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    @if (Session::has('success'))
        <script>
            iziToast.show({
                title: 'Success',
                message: "{{ Session::get('success') }}"

            });
        </script>
    @endif
    @if (Session::has('message'))
        <script>
            iziToast.show({
                title: 'Message',
                message: "{{ Session::get('message') }}"

            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            iziToast.show({
                title: 'Error',
                message: "{{ Session::get('error') }}"

            });
        </script>
    @endif

</body>

</html>
