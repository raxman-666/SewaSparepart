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
                                    <a href="#">Sewa Sparepart</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Sparepart</li>
                            </ul>
                        </div>
                        @if(auth()->user()->level == 'pic')
                        <button type="button" class="au-btn au-btn-icon au-btn--green" data-kode="{{ $kd }}" data-toggle="modal" data-target="#FormModal">
                            <i class="zmdi zmdi-plus"></i>add item
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<section class="m-t-20">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table id="dt" class="table table-borderless table-data3">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
                                <tr>
                                    <td>{{ !empty($i)  ? ++$i : ($i = 1) }}</td>
                                    <td>{{ $row->kode_barang }}</td>
                                    <td><img style="max-height:65px" src="storage/sparepart-images/{{ $row->image }}" class="rounded mx-auto d-block" alt="..."></td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>
                                        <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ViewModal" data-image="{{ $row->image }}" data-nama="{{ $row->nama }}" data-jenis="{{ $row->jenis_barang }}" data-jumlah="{{ $row->jumlah }}" data-tanggal="{{ $row->created_at }}"><i class="fas fa-eye"></i></a>
                                        @if(auth()->user()->level == 'pic')
                                        <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-mode="edit" data-kode="{{ $row->kode_barang }}" data-image="{{ $row->image }}" data-nama="{{ $row->nama }}" data-jenis="{{ $row->jenis_barang }}" data-jumlah="{{ $row->jumlah }}" data-tanggal="{{ $row->tanggal }}" data-target="#FormModal"><i class="fas fa-edit"></i></a>
                                        <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-kode="{{ $row->kode_barang }}" data-image="{{ $row->image }}" data-nama="{{ $row->nama }}" data-target="#DeleteModal"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</section>
@include('sweetalert::alert')
@include('sparepart/action')
@endsection
@push('script')
<script>
    $('#dt').DataTable();
    $(function() {
        $('#ViewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var image = button.data('image');
            var nama = button.data('nama');
            var jenis = button.data('jenis');
            var jumlah = button.data('jumlah');
            var tanggal = button.data('tanggal');
            var modal = $(this);

            modal.find('.modal-body #image').attr('src', 'storage/sparepart-images/' + image);
            modal.find('.modal-body #nama').text(nama);
            modal.find('.modal-body #jenis').text(jenis);
            modal.find('.modal-body #jumlah').text(jumlah);
            modal.find('.modal-body #tanggal').text(tanggal);
            modal.find('.modal-body #method').html('{{ method_field("patch") }}');
        });

        $('#FormModal').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var kode = button.data('kode');
            var mode = button.data('mode');
            var image = button.data('image');
            var nama = button.data('nama');
            var jenis = button.data('jenis');
            var jumlah = button.data('jumlah');
            var tanggal = button.data('tanggal');
            var modal = $(this);
            if (mode == 'edit') {

                modal.find('.modal-title').text('Edit Data Sparepart');
                modal.find('.modal-body #prevImageLama').remove();
                modal.find('.modal-body #lbPrevImageLama').remove();
                modal.find('.modal-body #kode').val(kode);
                modal.find('.modal-body #prevImage').prepend("<label id='lbPrevImageLama' class='form - control - label '>Gambar</label>");
                modal.find('.modal-body #prevImage').append("<img src='' id='prevImageLama'>");
                modal.find('.modal-body #prevImageLama').attr('src', 'storage/sparepart-images/' + image);
                modal.find('.modal-body #lbGambar').text("Pilih Gambar Baru ( JPEG,JPG,PNG )");
                modal.find('.modal-body #gambarLama').val(image);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #jenis').val(jenis);
                modal.find('.modal-body #jumlah').val(jumlah);
                modal.find('.modal-body #method').html('{{ method_field("patch") }}');
            } else {

                modal.find('.modal-title').text('Tambah Data Sparepart');
                modal.find('.modal-body #kode').val(kode);
                modal.find('.modal-body #prevImageLama').remove();
                modal.find('.modal-body #lbPrevImageLama').remove();
                modal.find('.modal-body #lbGambar').text("Pilih Gambar ( JPEG,JPG,PNG )");
                modal.find('.modal-body #gambaLama').val('');
                modal.find('.modal-body #nama').val('');
                modal.find('.modal-body #jenis').val('');
                modal.find('.modal-body #jumlah').val('');
                modal.find('.modal-body #method').html('');
            }
        });

        $('#DeleteModal').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var id = button.data('kode');
            var image = button.data('image');
            var nama = button.data('nama');
            var modal = $(this);
            modal.find('.modal-body #idHapus').val(id);
            modal.find('.modal-body #gambarLama').val(image);
            modal.find('.modal-body #dataHapus').text(nama);
        });
    });
</script>
@endpush