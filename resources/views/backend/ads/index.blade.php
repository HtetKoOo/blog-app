@extends('backend.layouts.app')
@section('title', 'Ads')
@section('ads-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Ads</div>
        </div>
    </div>
</div>

<div class="pt-3">
    <a href="{{url('admin/ads/create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Ads</a>
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
                        <th>Link</th>
                        <th>Status</th>
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
            ajax: "/admin/ads/datatable/ssd",
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
                    data: "link",
                    name: "link"
                },
                {
                    data: "status",
                    name: "status"
                },
                {
                    data: "action",
                    name: "action",
                    searchable: false,
                    sortable: false
                },
            ],
        });

        $(document).on('click', '.delete-ads', function() {
            var id = $(this).data('id');
            var form = $('#delete-ads-form');
            form.attr('action', '/admin/ads/' + id);
            $('#deleteAdsModal').modal('show');
        });

        // Add inside your $(document).ready(function() { ... });
        $(document).on('click', '.detail', function() {
            var id = $(this).data('id');
            $.get('/admin/ads/' + id + '/detail', function(ads) {
                let html = `
            <strong>Title:</strong> ${ads.title}<br>
            <strong>Description:</strong> ${ads.description}<br>
            <img src="${ads.image_url}" class="img-fluid mt-2" alt="Ads Image">
            `;
                $('#ads-detail-content').html(html);
                $('#adsDetailModal').modal('show');
            });
        });
    });
</script>
@endsection

<!-- Ads Detail Modal -->
<div class="modal fade" id="adsDetailModal" tabindex="-1" role="dialog" aria-labelledby="adsDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adsDetailModalLabel">Ads Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Details will be loaded here -->
                <div id="ads-detail-content"></div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAdsModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="delete-ads-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAdsModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this ads?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>