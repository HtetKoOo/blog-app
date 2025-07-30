@extends('backend.layouts.app')
@section('title', 'Articles')
@section('article-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Articles</div>
        </div>
    </div>
</div>

<div class="pt-3">
    <a href="{{url('admin/article/create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Article</a>
</div>

<div class="content py-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered Datatable">
                <thead>
                    <tr class="bg-light">
                        <th>ID</th>
                        <th>Title</th>
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
            ajax: "/admin/article/datatable/ssd",
            columns: [{
                    data: "id",
                    name: "id",
                },
                {
                    data: "title",
                    name: "title",
                },
                {
                    data: "description",
                    name: "description",
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

        $(document).on('click', '.delete-article', function() {
            var id = $(this).data('id');
            var form = $('#delete-article-form');
            form.attr('action', '/admin/article/' + id);
            $('#deleteArticleModal').modal('show');
        });

        // Add inside your $(document).ready(function() { ... });
        $(document).on('click', '.detail', function() {
            var id = $(this).data('id');
            $.get('/admin/article/' + id + '/detail', function(data) {
                let tags = data.tag.map(t => t.name).join(', ');
                let programmings = data.programming.map(p => p.name).join(', ');
                let html = `
            <strong>Title:</strong> ${data.title}<br>
            <strong>Description:</strong> ${data.description}<br>
            <strong>Tags:</strong> ${tags}<br>
            <strong>Programmings:</strong> ${programmings}<br>
            <img src="/storage/${data.image}" class="img-fluid mt-2" alt="Article Image">
            `;
                $('#article-detail-content').html(html);
                $('#articleDetailModal').modal('show');
            });
        });
    });
</script>
@endsection

<!-- Article Detail Modal -->
<div class="modal fade" id="articleDetailModal" tabindex="-1" role="dialog" aria-labelledby="articleDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="articleDetailModalLabel">Article Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Details will be loaded here -->
                <div id="article-detail-content"></div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteArticleModal" tabindex="-1" role="dialog" aria-labelledby="deleteArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="delete-article-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteArticleModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this article?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>