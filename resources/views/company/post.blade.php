@extends('layouts.app')

@section('body')
<br>
<div class="container">
    <form id="postForm" action="{{ route('internship.post.save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
        </div>

        <!-- Custom Photo Upload -->
        <div class="form-group">
            <label><strong>Post Image</strong></label><br>
            <input type="file" id="photo" name="photo" accept="image/*" style="display: none;" onchange="previewPhoto(this)">
            <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('photo').click();">
                + Add Photo
            </button>
            <div id="file-name" class="mt-2 text-muted" style="font-size: 0.9rem;"></div>
            <div id="photo-preview" class="mt-3" style="display: none;">
                <img id="preview-img" src="#" alt="Selected Image" class="img-thumbnail" style="max-height: 200px;">
            </div>
        </div>

        <!-- Requirements -->
        <div class="form-group">
            <label for="requirements">Requirements</label>
            <input type="text" class="form-control" id="requirements" name="requirements" placeholder="Enter requirements" required>
        </div>

        <!-- Start and End Dates -->
        <div class="form-group row">
            <div class="col-md-6">
                <label for="start_time">Start Date</label>
                <input type="date" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="col-md-6">
                <label for="end_time">End Date</label>
                <input type="date" class="form-control" id="end_time" name="end_time" required>
            </div>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter description" required></textarea>
        </div>

        <!-- Show Modal Button -->
        <div class="text-right">
            <button type="button" class="btn btn-primary" onclick="fillModal()" data-toggle="modal" data-target="#previewModal">Preview Post</button>
        </div>

        <!-- Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content shadow border-0 rounded" style="font-family: 'Segoe UI', sans-serif;">
  
        <!-- Modal Content -->
        <div class="modal-body bg-white p-4">
  
          <!-- Title -->
          <h3 id="modal-title" class="fw-bold text-center text-dark mb-2" style="font-size: 1.5rem;"></h3>
  
          <!-- Description -->
          <p id="modal-description" class="text-muted text-center mb-4" style="font-size: 1.05rem;"></p>
  
          <!-- Image -->
          <div id="modal-photo-wrapper" class="text-center mb-4" style="display: none;">
            <img id="modal-photo" src="#" alt="Post Image" class="img-fluid rounded" style="max-height: 300px;">
          </div>
  
          <!-- Dates and Requirements -->
          <div class="row text-center mb-3">
            <div class="col-md-4">
              <strong class="text-muted">Start Date</strong>
              <div id="modal-start" class="text-dark"></div>
            </div>
            <div class="col-md-4">
              <strong class="text-muted">End Date</strong>
              <div id="modal-end" class="text-dark"></div>
            </div>
            <div class="col-md-4">
              <strong class="text-muted">Requirements</strong>
              <div id="modal-requirements" class="text-dark"></div>
            </div>
          </div>
  
        </div>
  
        <!-- Footer Buttons -->
        <div class="modal-footer justify-content-center bg-light py-3 rounded-bottom">
          <button type="button" class="btn btn-outline-secondary w-25" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary w-25">Post</button>
        </div>
      </div>
    </div>
  </div>
  
  
    </form>
</div>

<!-- JS Logic -->
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
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (for Bootstrap 4 tooltips/modals) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS (v4.6) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

@endsection
