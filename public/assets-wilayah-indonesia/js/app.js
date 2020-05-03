$( document ).ready(function() {
   //untuk memanggil plugin select2
   $('#provinsi').select2({
       placeholder: 'Pilih Provinsi',
       language: "id"
   });
   $('#kota').select2({
       placeholder: 'Pilih Kota/Kabupaten',
       language: "id"
   });
   $('#kecamatan').select2({
       placeholder: 'Pilih Kecamatan',
       language: "id"
   });
   $('#kelurahan').select2({
       placeholder: 'Pilih Kelurahan',
       language: "id"
   });

   //script tambahan untuk csrf
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   //saat pilihan provinsi di pilih maka mengambil data di data-wilayah menggunakan ajax
   $("#provinsi").change(function(){
       $("img#load1").show();
       var id_provinces = $(this).val();
       $.ajax({
           type: "POST",
           dataType: "html",
           url: "/wilayah/get/kota",
           data: "id_provinces="+id_provinces,
           success: function(msg){
               $("select#kota").html(msg);
               $("img#load1").hide();
               getAjaxKota();
           }
       });
   });

   $("#kota").change(getAjaxKota);
   function getAjaxKota(){
       $("img#load2").show();
       var id_regencies = $("#kota").val();
       $.ajax({
           type: "POST",
           dataType: "html",
           url: "/wilayah/get/kecamatan",
           data: "id_regencies="+id_regencies,
           success: function(msg){
               $("select#kecamatan").html(msg);
               $("img#load2").hide();
           getAjaxKecamatan();
           }
       });
   }

   $("#kecamatan").change(getAjaxKecamatan);
   function getAjaxKecamatan(){
       $("img#load3").show();
       var id_district = $("#kecamatan").val();
       $.ajax({
           type: "POST",
           dataType: "html",
           url: "/wilayah/get/kelurahan",
           data: "id_district="+id_district,
           success: function(msg){
               $("select#kelurahan").html(msg);
               $("img#load3").hide();
           }
       });
   }
});