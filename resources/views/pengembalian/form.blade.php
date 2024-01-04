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
                                <li class="list-inline-item">Pengembalian</li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Pengajuan</li>
                            </ul>
                        </div>
                        <a href="pengembalian" type="button" class="au-btn au-btn-icon au-btn--green">
                            Kembali
                        </a>
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
                        <form action="{{ url('kembali') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="kode" class="form-control-label">Nama Sparepart</label>
                                <select name="kode_barang" class="form-control">
                                    @foreach ($result as $row)
                                    <option id="kode nama" value="<?= $row['kode_barang']; ?>"><?= $row['nama']; ?></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah" class=" form-control-label">Jumlah Dikembalikan</label>
                                <input type="number" id="jumlahkembali" name="jumlah_dikembalikan" placeholder="Jumlah Dikembalikan.." class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class=" form-control-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class=" form-control-label">Deskripsi Kebutuhan</label>
                                <textarea name="deskripsi_kebutuhan" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- END DATA TABLE-->
            </div>
        </div>
    </div>
    </div>
</section>
@include('sweetalert::alert')
@endsection