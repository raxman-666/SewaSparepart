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
                                <li class="list-inline-item">Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<section class="statistic" style="height: 464px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <!-- DATA TABLE-->
            <div class="m-b-40">
                <h5>Welcome {{ auth()->user()->name }}</h5>
            </div>
            <div class="table-responsive m-b-40">
                <table id="dt" class="table table-borderless table-data3">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $row)
                        <tr>
                            <td>{{ !empty($i)  ? ++$i : ($i = 1) }}</td>
                            <td><img style="max-height:65px" src="storage/sparepart-images/{{ $row->image }}" class="rounded mx-auto d-block" alt="..."></td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
</section>
@endsection