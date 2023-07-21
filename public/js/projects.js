$(document).ready(function(){

    var table = '#kontraks-table';
    var modal = '#add-kontraks-modal';
    var form = '#add-kontraks-form';
    var sjabatan ='#jabatan';
    var spegawai ='#pegawai';

    $(form).on('submit', function(event){
        event.preventDefault();

        var url = $(this).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $(form).trigger("reset");
                $(modal).modal('hide');
                window.location='/';
            },
            error: function(response) {
                console.log (response.responseJSON.errors);
                $('#msg').html(JSON.stringify(response.responseJSON.errors))
            }
        });
    });
        $(sjabatan).find('option').not(':first').remove();

        // AJAX request 
        $.ajax({
            url: '/getJabatan',
            type: 'get',
            dataType: 'json',
            success: function(response){

                var len = 0;
                if(response['data'] != null){
                     len = response['data'].length;
                }

                if(len > 0){
                     // Read data and create <option >
                     for(var i=0; i<len; i++){

                          var id = response['data'][i].id;
                          var name = response['data'][i].nama_jabatan;

                          var option = "<option value='"+id+"'>"+name+"</option>";

                          $(sjabatan).append(option); 
                     }
                }

            }
        });
        $(spegawai).find('option').not(':first').remove();

        // AJAX request 
        $.ajax({
            url: '/getPegawai',
            type: 'get',
            dataType: 'json',
            success: function(response){

                var len = 0;
                if(response['data'] != null){
                     len = response['data'].length;
                }

                if(len > 0){
                     // Read data and create <option >
                     for(var i=0; i<len; i++){

                          var id = response['data'][i].id;
                          var name = response['data'][i].nama_pegawai;

                          var option = "<option value='"+id+"'>"+name+"</option>";

                          $(spegawai).append(option); 
                     }
                }

            }
        });
});
function edit (data){
    console.log(data)
    $('#lama_kontrak').val(data.lama_kontrak)
    $('#id').val(data.id)
    $('#jabatan').val(data.jabatan_pegawai_id)
    $('#pegawai').val(data.pegawai.nama_pegawai)

}
