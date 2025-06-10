<div class="modal fade" id="taskStatusUpdate{{ $task->id }}" tabindex="-1"
    aria-labelledby="taskStatusUpdateLabel{{ $task->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="taskStatusUpdateLabel{{ $task->id }}">Update Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('task.status', ['uuid' => $task->uuid]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Status Update</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Task Name</label>
                                <input type="text" name="task_name" id="task_name" disabled
                                    value="{{ $task->task_name }}" class="form-control">
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
</div>
