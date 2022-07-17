<!-- Form Elements -->
                    <div class="panel panel-default">
                           <div class="panel-heading">
                                 Daftar Penyakit Tanaman Tersimpan
                            </div>
                             <div class="panel-body">
                                      <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                         <th>Edit/Detail</th>
                                                         <th>Hapus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>   
                                                    <?php $hitung=0; foreach ($data_penyakit as $penyakit) { ?>
                                                    <tr>
                                                        <td><?=++$hitung;?></td>
                                                        <td><?= $penyakit->nama ?></td>
                                                        <td><a href="javascript:void(0);" onclick="edit_detail(<?= $penyakit->id ?>)">Edit/Detail</a></td>
                                                        <td><a href="javascript:void(0);" onclick="hapus(<?= $penyakit->id ?>)">Hapus</a></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                      </div>   
                             </div>     
                   </div>

<script>       
         //fungsi untuk menghapus tanaman
         function hapus(id){
             var r = confirm("Apakah anda yakin ingin menghapus data ini?");
                if (r === true) {
                         //tampilkan overlay loading
                        $("#page-wrapper").LoadingOverlay("show", {
                            color   : "rgba(128,128,128, 0.8)"
                         });  
                          $.ajax({
                            url : '<?= base_url(); ?>index.php/AjaxDbPenyakit/hapus_penyakit',
                            //mengirimkan data id ke edit_tanah
                            data : {
                                id: id
                            }, 
                            //Method pengiriman
                            type : 'POST',
                            //Data yang akan diambil dari script pemroses
                            dataType: 'html',
                            //Respon jika data berhasil dikirim
                            success : function(pesan){
                                  //sembunyikan overlay loading
                                     $("#page-wrapper").LoadingOverlay("hide");    
                                    if(pesan === 'sukses'){
                                             alert('Data berhasil dihapus');
                                             ajax('daftar_penyakit', 'AjaxPenyakit/daftar_penyakit');
                                    }else{
                                        alert(pesan);
                                    }
                            }
                        });
                }
         }
    
          //fungsi untuk mengedit dan melihat detail berdasarkan idi tanah yang dipilih
          function edit_detail(id){
              //set aktif dan nonaktif navigasi menu
              navigasi_aktif.classList.remove('active-menu');
              navigasi_aktif = document.getElementById('edit_penyakit');
              navigasi_aktif.classList.add('active-menu');
              //tampilkan overlay loading
              $("#page-wrapper").LoadingOverlay("show", {
                  color   : "rgba(128,128,128, 0.8)"
               });  
                $.ajax({
                  url : '<?= base_url(); ?>index.php/AjaxPenyakit/edit_penyakit',
                  //mengirimkan data id ke edit_tanah
                  data : {
                      id: id
                  }, 
                  //Method pengiriman
                  type : 'POST',
                  //Data yang akan diambil dari script pemroses
                  dataType: 'html',
                  //Respon jika data berhasil dikirim
                  success : function(pesan){
                          $("#page-wrapper").html(pesan);
                           $("#page-wrapper").LoadingOverlay("hide");    
                  }
              });
          }
</script>
