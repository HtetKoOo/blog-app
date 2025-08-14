@extends('backend.layouts.app')
@section('title', 'Music Video Lists')
@section('mv-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Music Video Lists</div>
        </div>
    </div>
</div>

<div class="pt-3">
    <a href="{{url('admin/music-video/create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Music Video</a>
</div>

<div class="content py-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered Datatable">
                <thead>
                    <tr class="bg-light">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Singer</th>
                        <th>Music mp3 file</th>
                        <th>File Size</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('.Datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/music-video/datatable/ssd",
            columns: [{
                    data: "id",
                    name: "id",
                },
                {
                    data: "title",
                    name: "title",
                },
                {
                    data: "singer",
                    name: "singer",
                },
                {
                    data: "music_url",
                    name: "music_url",
                },
                {
                    data: "file_size",
                    name: "file_size",
                },
                {
                    data: "duration",
                    name: "duration",
                },
                {
                    data: "action",
                    name: "action",
                    searchable: false,
                    sortable: false
                },
            ],
        });

        // for mp3 player to listen
        $(document).on('click', '.play-audio', function() {
            let audioUrl = $(this).data('url');
            $('#listenAudioSource').attr('src', audioUrl);
            let audio = $('#listenAudioPlayer')[0];
            audio.load();
            audio.play();
            $('#audioModal').modal('show');
        });
        $('#audioModal').on('hidden.bs.modal', function() {
            let audio = $('#listenAudioPlayer')[0];
            audio.pause();
            audio.currentTime = 0;
        });

        // Delete Music Video modal
        $(document).on('click', '.delete-mv', function() {
            var id = $(this).data('id');
            var form = $('#delete-mv-form');
            form.attr('action', '/admin/music-video/' + id);
            $('#deleteMVModal').modal('show');
        });

        // Add inside your $(document).ready(function() { ... });
        $(document).on('click', '.detail', function() {
            var id = $(this).data('id');

            $.get('/admin/music-video/' + id + '/detail', function(mv) {
                // Convert duration and file size
                let durationText = '-';
                if (mv.duration) {
                    let minutes = Math.floor(mv.duration / 60);
                    let seconds = mv.duration % 60;
                    durationText = `${minutes}:${seconds.toString().padStart(2,'0')}`;
                }
                let sizeText = '-';
                if (mv.file_size) {
                    let size = parseInt(mv.file_size);
                    if (size >= 1048576) sizeText = (size / 1048576).toFixed(2) + ' MB';
                    else if (size >= 1024) sizeText = (size / 1024).toFixed(2) + ' KB';
                    else sizeText = size + ' bytes';
                }

                // HTML
                let html = `
            <strong>Title:</strong> ${mv.title}<br>
            <strong>Description:</strong> ${mv.description || '-'}<br>
            <strong>Singers:</strong> ${mv.singers.join(', ')}<br>
            <strong>Genres:</strong> ${mv.genres.join(', ')}<br>
            <strong>Duration:</strong> ${durationText}<br>
            <strong>File Size:</strong> ${sizeText}<br>
            <img src="${mv.thumbnail_url}" class="img-fluid mt-2 mb-2" alt="Thumbnail">
        `;

                $('#mv-detail-content').html(html);
                $('#mvDetailModal').modal('show');
            });
        });
    });
</script>
@endsection

<!-- MV Detail Modal -->
<div class="modal fade" id="mvDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-2" style="border-radius: 8px;">
            <button type="button" class="close ml-auto mr-1 mt-1" data-dismiss="modal" aria-label="Close" style="font-size: 1.5rem;">
                <span aria-hidden="true">&times;</span>
            </button>
            <div id="mv-detail-content"></div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteMVModal" tabindex="-1" role="dialog" aria-labelledby="deleteMVModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="delete-mv-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMVModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this music_video?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Audio Player Modal -->
<div class="modal fade" id="audioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog column">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Listen to Music</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <audio id="listenAudioPlayer" controls style="width: 100%;">
                    <source id="listenAudioSource" src="${mv.music_url}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    </div>
</div>