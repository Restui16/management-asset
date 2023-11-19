<div class="modal fade" id="createLocation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Add Location</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('store.location') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="name">Location Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name')}}">

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    <label for="descriptiom">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                        id="">{{old('description')}}</textarea>

                    @error('description')
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