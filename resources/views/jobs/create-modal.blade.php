<div class="modal fade" id="createJob" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Add Job</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('store.job') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="job_title">Job Title</label>
                    <input type="text" id="job_title" name="job_title" class="form-control @error('job_title') is-invalid @enderror"
                        value="{{ old('job_title')}}">

                    @error('job_title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer mt-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>