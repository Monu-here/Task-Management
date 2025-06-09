 @php
     $projects = DB::table('projects')->get();
 @endphp
 <div class="modal fade" id="taskAdd" tabindex="-1" aria-labelledby="taskAddLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="taskAddLabel">Add Task</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('task.add') }}" method="POST">
                     @csrf
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="name">Task Name</label>
                                 <input type="text" name="task_name" id="task_name" class="form-control">
                             </div>

                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="project_id">Project</label>
                                 <select name="project_id" id="project_id" class="form-control">
                                     <option value="" selected disabled>Select Project</option>
                                     @foreach ($projects as $project)
                                         <option value="{{ $project->id }}">{{ $project->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="description">Description</label>
                                 <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
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
