function addData(endpoint, data, type = '') {
    var type = 'json';
    if(type == 'form-data'){
        type = false;
    } 
    $('.alert').html("");
    $.ajax({
        type: "POST",
        url: endpoint,
        data: data,
        dataType: type,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if(response.message == "success"){
                $('.alert-success').show();
                $('.alert-success').html("Success saving data.");
                $('form-control').val('');
            }
        },error: function (request, error) {
            $('.alert-danger').show();
            $('.alert-danger').html(request.responseJSON.message);
        }
    });
}
function updateData(endpoint, data, typeForm = '') {
    var dataType = 'json';
    var type = 'PATCH';
    if(typeForm == 'form-data'){
        dataType = false;
        type = 'POST';
    } 
    $('.alert').html();
    $.ajax({
        type: type,
        url: endpoint,
        data: data,
        dataType: dataType,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if(response.message == "success"){
                $('.alert-success').show();
                $('.alert-success').html("Success saving data.");
                $('form-control').val('');
            }
        },error: function (request, error) {
            $('.alert-danger').show();
            $('.alert-danger').html(request.responseJSON.message);
        }
    });
}

function deleteData(endpoint, data) {
    $('.alert').html();
    $.ajax({
        type: "DELETE",
        url: endpoint,
        data: data,
        dataType: 'json',
        success: function (response) {
            if(response.message == "success"){
                $('.alert-success').show();
                $('.alert-success').html("Success delete data.");
            }
        }
    });
}