<!-- ModalHapus -->
<div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Peringatan !</h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('setstatkembali') }}" method="post">
                    @csrf
                    {{ method_field('patch') }}
                    <input type="hidden" name="stat" id="sts" value="">
                    <input type="hidden" name="id_pengembalian" id="id" value="">
                    <input type="hidden" name="kode_barang" id="kode" value="">
                    <input type="hidden" name="deskripsi_kebutuhan" id="deskripsi" value="">
                    <input type="hidden" name="jumlah_dikembalikan" id="jml" value="">
                    <input type="hidden" name="tanggal" id="tanggal" value="">
                    <input type="hidden" name="status" id="status" value="">
                    <label for="status" class=" form-control-label">Apakah Anda Yakin Ingin <b id="stat"></b> permintaan ini ? </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- ModalView -->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Details Peminjaman</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table noBorder">
                        <tr>
                            <td><b>Nama Sparepart</b></td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <td><b>Deskripsi Kebutuhan</b></td>
                            <td id="deskripsi"></td>
                        </tr>

                        <tr>
                            <td><b>Jumlah Dikembalikan</b></td>
                            <td id="jumlah"></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td id="tanggal"></td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td id="status"></td>
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