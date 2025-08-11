@extends('backend.layouts.app')
@section('title', 'Music Genre Lists')
@section('mg-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Music Genre Lists</div>
        </div>
    </div>
</div>

<div class="pt-3">
    <a href="{{url('admin/music-genre/create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Add Music Genre</a>
</div>

<div class="content py-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered Datatable">
                <thead>
                    <tr class="bg-light">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Updated at</th>
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
            ajax: "/admin/music-genre/datatable/ssd",
            columns: [{
                    data: "id",
                    name: "id",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "description",
                    name: "description",
                },
                {
                    data: "created_at",
                    name: "created_at",
                },
                {
                    data: "updated_at",
                    name: "updated_at",
                },
                {
                    data: "action",
                    name: "action",
                    searchable: false,
                    sortable: false
                },
            ],
        });
    });

    $(document).on('click', '.delete-mg', function() {
        var id = $(this).data('id');
        var form = $('#delete-mg-form');
        form.attr('action', '/admin/music-genre/' + id);
        $('#deleteMusicGenreModal').modal('show');
    });
</script>
@endsection

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteMusicGenreModal" tabindex="-1" role="dialog" aria-labelledby="deleteMusicGenreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="delete-mg-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMusicGenreModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this music genre?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>