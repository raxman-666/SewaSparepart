@extends('templates.main')
@section('content')
<!-- BREADCRUMB-->
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here :</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Status Barang</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Pengembalian</li>
                            </ul>
                        </div>
                        @if(auth()->user()->level == 'pic')

                        @else
                        <a href="tambahpengembalian" type="button" class="au-btn au-btn-icon au-btn--green">
                            <i class="zmdi zmdi-plus"></i>Buat Permintaan
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<section>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table id="dt" class="table table-borderless table-data3">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Sparepart</th>
                                    <th>Deskripsi Kebutuhan</th>
                                    <th>Jumlah Tersedia</th>
                                    <th>Jumlah Dipinjam</th>
                                    <th>Tanggal</th>
                                    @if(auth()->user()->level == 'pic')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                @if ($row->status == 'waiting')
                                <tr>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->deskripsi_kebutuhan }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>{{ $row->jumlah_dikembalikan }}</td>
                                    <td>{{ $row->tanggal }}</td>
                                    @if(auth()->user()->level == 'pic')
                                    <td>
                                        <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#ConfirmModal" data-id="{{ $row->id_pengembalian }}" data-kode="{{ $row->kode_barang }}" data-deskripsi="{{ $row->deskripsi_kebutuhan }}" data-jumlah="{{ $row->jumlah_dikembalikan }}" data-tanggal="{{ $row->tanggal }}" data-status="{{ 'approve' }}" data-stat="{{ 'Menerima' }}"><i class=" fas fa-check"></i></a>
                                        <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#ConfirmModal" data-id="{{ $row->id_pengembalian }}" data-kode="{{ $row->kode_barang }}" data-deskripsi="{{ $row->deskripsi_kebutuhan }}" data-jumlah="{{ $row->jumlah_dikembalikan }}" data-tanggal="{{ $row->tanggal }}" data-status="{{ 'cancel' }}" data-stat="{{ 'Menolak' }}"><i class=" fas fa-times"></i></a>
                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            @if(auth()->user()->level == 'pic')
            <div class="row">
                <div class="col-xl-6">
                    <!-- USER DATA-->
                    <div class="user-data m-b-40">
                        <h3 class="title-3 m-b-30">
                            Approve
                        </h3>
                        <div class="table-responsive table-data">
                            <table id="dt" class="table">
                                <thead>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                    @if ($row->status == 'approve')
                                    <tr>
                                        <td>
                                            <div class="table-data__info">
                                                <h6>{{ $row->tanggal }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="role user">Approve</span>
                                        </td>
                                        <td>
                                            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ViewModal" data-nama="{{ $row->nama }}" data-deskripsi="{{ $row->deskripsi_kebutuhan }}" data-jumlah="{{ $row->jumlah_dikembalikan }}" data-tanggal="{{ $row->tanggal }}" data-status="{{ $row->status }}"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END USER DATA-->
                </div>
                <div class="col-xl-6">
                    <!-- USER DATA-->
                    <div class="user-data m-b-40">
                        <h3 class="title-3 m-b-30">
                            Cancel
                        </h3>
                        <div class="table-responsive table-data">
                            <table id="dt" class="table">
                                <thead>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                    @if ($row->status == 'cancel')
                                    <tr>
                                        <td>
                                            <div class="table-data__info">
                                                <h6>{{ $row->tanggal }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="role admin">cancel</span>
                                        </td>
                                        <td>
                                            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ViewModal" data-nama="{{ $row->nama }}" data-deskripsi="{{ $row->deskripsi_kebutuhan }}" data-jumlah="{{ $row->jumlah_dikembalikan }}" data-tanggal="{{ $row->tanggal }}" data-status="{{ $row->status }}"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END USER DATA-->
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@include('pengembalian/action')
@include('sweetalert::alert')
@endsection
@push('script')
<script>
    $('#dt').DataTable();
    $('#ConfirmModal').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget);
        var id = button.data('id');
        var kode = button.data('kode');
        var deskripsi = button.data('deskripsi');
        var jumlah = button.data('jumlah');
        var tanggal = button.data('tanggal');
        var status = button.data('status');
        var stat = button.data('stat');
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #kode').val(kode);
        modal.find('.modal-body #deskripsi').val(deskripsi);
        modal.find('.modal-body #jml').val(jumlah);
        modal.find('.modal-body #tanggal').val(tanggal);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #stat').text(stat);
        modal.find('.modal-body #sts').val(stat);
    });

    $('#ViewModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var image = button.data('image');
        var nama = button.data('nama');
        var deskripsi = button.data('deskripsi');
        var jumlah = button.data('jumlah');
        var tanggal = button.data('tanggal');
        var status = button.data('status');
        var modal = $(this);

        modal.find('.modal-body #image').attr('src', 'storage/sparepart-images/' + image);
        modal.find('.modal-body #nama').text(nama);
        modal.find('.modal-body #deskripsi').text(deskripsi);
        modal.find('.modal-body #jumlah').text(jumlah);
        modal.find('.modal-body #tanggal').text(tanggal);
        modal.find('.modal-body #status').text(status);
    });
</script>
@endpush