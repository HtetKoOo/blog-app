@extends('backend.layouts.app')
@section('title', 'Programming Languages')
@section('programming-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Programming Languages</div>
        </div>
    </div>
</div>

<div class="pt-3">
    <a href="{{url('admin/programming/create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Programming Language</a>
</div>

<div class="content py-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered Datatable">
                <thead>
                    <tr class="bg-light">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
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
            ajax: "/admin/programming/datatable/ssd",
            columns: [{
                    data: "id",
                    name: "id",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "slug",
                    name: "slug",
                },
                {
                    data: "created_at",
                    name: "created_at"
                },
                {
                    data: "updated_at",
                    name: "updated_at"
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

    $(document).on('click', '.delete-programming', function() {
        var id = $(this).data('id');
        var form = $('#delete-programming-form');
        form.attr('action', '/admin/programming/' + id);
        $('#deleteProgrammingModal').modal('show');
    });
</script>
@endsection

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteProgrammingModal" tabindex="-1" role="dialog" aria-labelledby="deleteProgrammingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="delete-programming-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProgrammingModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this programming?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>