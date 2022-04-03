
function getDataTables(tableID, endpoint){
    var dataTable = $('#'+tableID).DataTable( {
        processing: true,
        serverSide: true,
        paging:true,
        ajax: {
            url: endpoint,
            dataFilter: function(data){
                var json = jQuery.parseJSON( data );
                return JSON.stringify( json ); 
            }
        }
    } );

    return dataTable.ajax.reload();
}