 <div class="modal fade" id="projectUpdate{{ $project->id }}" tabindex="-1"
     aria-labelledby="projectUpdateLabel{{ $project->id }}" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="projectUpdateLabel{{ $project->id }}">Edit Project</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('project.update', ['uuid' => $project->uuid]) }}" method="POST">
                     @csrf
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="name">Project Name</label>
                                 <input type="text" name="name" id="name" value="{{ $project->name }}"
                                     class="form-control">
                             </div>

                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="color_code">Pick Color</label>
                                 <input type="color" name="color_code" id="color_code"
                                     value="{{ $project->color_code }}" class="form-control">
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
