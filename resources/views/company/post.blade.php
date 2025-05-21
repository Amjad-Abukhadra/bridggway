@extends('layouts.app')

@section('body')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create New Internship
                </h2>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">Internship Details</h6>
            </div>
            <div class="card-body">
                <form id="postForm" action="{{ route('internship.post.save') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter internship position title" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Post Image</label><br>
                        <input type="file" id="photo" name="photo" accept="image/*" style="display: none;"
                            onchange="previewPhoto(this)">
                        <button type="button" class="btn btn-outline-primary"
                            onclick="document.getElementById('photo').click();">
                            <i class="fas fa-image mr-1"></i> Add Photo
                        </button>
                        <div id="file-name" class="mt-2 text-muted" style="font-size: 0.9rem;"></div>
                        <div id="photo-preview" class="mt-3" style="display: none;">
                            <img id="preview-img" src="#" alt="Selected Image" class="img-thumbnail"
                                style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Requirements</label>
                        <input type="text" class="form-control" id="requirements" name="requirements"
                            placeholder="Enter internship requirements" required>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="font-weight-bold">Start Date</label>
                            <input type="date" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">End Date</label>
                            <input type="date" class="form-control" id="end_time" name="end_time" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5"
                            placeholder="Enter detailed description of the internship position" required></textarea>
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-primary px-4" onclick="fillModal()" data-toggle="modal"
                            data-target="#previewModal">
                            <i class="fas fa-eye mr-1"></i> Preview Post
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog"
                        aria-labelledby="previewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white py-3">
                                    <h6 class="modal-title font-weight-bold m-0">
                                        <i class="fas fa-eye mr-2"></i>
                                        Preview Internship Post
                                    </h6>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <h3 id="modal-title" class="font-weight-bold text-center mb-3"></h3>

                                    <div id="modal-photo-wrapper" class="text-center mb-4" style="display: none;">
                                        <img id="modal-photo" src="#" alt="Post Image"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 300px; object-fit: contain;">
                                    </div>

                                    <div class="row text-center mb-4">
                                        <div class="col-md-4">
                                            <div class="font-weight-bold text-primary mb-1">Start Date</div>
                                            <div id="modal-start" class="text-white"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="font-weight-bold text-primary mb-1">End Date</div>
                                            <div id="modal-end" class="text-white"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="font-weight-bold text-primary mb-1">Requirements</div>
                                            <div id="modal-requirements" class="text-white"></div>
                                        </div>
                                    </div>

                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <h6 class="font-weight-bold text-white mb-3">Description</h6>
                                            <p id="modal-description" class="text-white-50 mb-0"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times mr-1"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-paper-plane mr-1"></i> Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewPhoto(input) {
            const file = input.files[0];
            const fileNameLabel = document.getElementById('file-name');

            if (file) {
                fileNameLabel.textContent = 'Selected file: ' + file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('preview-img').style.display = 'block';
                    document.getElementById('photo-preview').style.display = 'block';

                    document.getElementById('modal-photo').src = e.target.result;
                    document.getElementById('modal-photo-wrapper').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                fileNameLabel.textContent = '';
                document.getElementById('photo-preview').style.display = 'none';
                document.getElementById('modal-photo-wrapper').style.display = 'none';
            }
        }

        function fillModal() {
            document.getElementById('modal-title').textContent = document.getElementById('title').value;
            document.getElementById('modal-description').textContent = document.getElementById('description').value;
            document.getElementById('modal-start').textContent = document.getElementById('start_time').value;
            document.getElementById('modal-end').textContent = document.getElementById('end_time').value;
            document.getElementById('modal-requirements').textContent = document.getElementById('requirements').value;
        }
    </script>
@endsection
