{{-- <div class="modal fade" id="taskupdate{{ $task->id }}" tabindex="-1"
    aria-labelledby="taskupdateLabel{{ $task->id }}" aria-hidden="true">
    @php
        $projects = DB::table('projects')->get();
    @endphp
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="taskupdateLabel{{ $task->id }}">
                    Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('task.update', ['uuid' => $task->uuid]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Task Name</label>
                                <input type="text" name="task_name" id="task_name" value="{{ $task->task_name }}"
                                    class="form-control">
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="project_id">Project</label>
                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="" disabled
                                        {{ old('project_id', $task->project_id) ? '' : 'selected' }}>
                                        Select Project
                                    </option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $task->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> --}}
