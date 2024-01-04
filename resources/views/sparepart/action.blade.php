<!-- ModalView -->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Details Sparepart</h5>
            </div>
            <div class="modal-body">
                <div class="mx-auto d-flex">
                    <img style="max-height:500px" class="mx-auto" src="" id="image" alt="Card image cap">
                </div>
                <hr>
                <div class="row">
                    <table class="table noBorder">
                        <tr>
                            <td><b>Nama Sparepart</b></td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <td><b>Jenis Barang</b></td>
                            <td id="jenis"></td>
                        </tr>

                        <tr>
                            <td><b>Jumlah</b></td>
                            <td id="jumlah"></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td id="tanggal"></td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Modal  -->
<div class="modal fade" id="FormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('sparepart') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="method"></div>
                    <input type="hidden" name="gambarLama" value="" id="gambarLama">
                    <div class="form-group">
                        <label for="kode" class="form-control-label">Kode Sparepart</label>
                        <input type="text" readonly id="kode" name="kode_barang" placeholder="" class="form-control">
                    </div>
                    <div class="form-group" id="prevImage" style="max-width: 200px;"></div>
                    <div class="form-group">
                        <label for="kode" id="lbGambar" class="form-control-label">Gambar ( JPEG,JPG,PNG )</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class=" form-control-label">Nama Barang</label>
                        <input type="text" id="nama" name="nama" placeholder="Nama Barang.." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_barang" class=" form-control-label">Jenis Barang</label>
                        <input type="text" id="jenis" name="jenis_barang" placeholder="Jenis Barang.." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jumlah" class=" form-control-label">Jumlah</label>
                        <input type="text" id="jumlah" name="jumlah" placeholder="Jumlah.." class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- ModalHapus -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data</h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('sparepart') }}" method="post">
                    @csrf
                    {{ method_field('delete') }}
                    <input type="hidden" name="kode" id="idHapus">
                    <input type="hidden" name="gambarLama" value="" id="gambarLama">
                    <label for="namaBarang" class=" form-control-label">Apakah Anda Yakin Ingin Menghapus Data <b id="dataHapus"></b> ? </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {
        bsCustomFileInput.init()
    })
</script>
@endpush