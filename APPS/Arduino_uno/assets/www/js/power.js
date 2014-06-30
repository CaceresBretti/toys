function on(){
    var Status = "1"
    url = "http://192.168.1.116:5000/on"
    data =  {status:Status}
    
    	$.ajax({
            url: url,
            // dataType: 'json',
            type : "get",
            data:data,
            crossDomain: true,
            complete: function(xhr, statusText){
                console.log(xhr.responseText);
            },
            success: function(result) {
                alert('Like done');
            },
            error: function( req, status, err ) {
                alert('Error establecer conecxión');
            }
        });
    return false;
}

function off(){
    var Status = "0"
    url = "http://192.168.2.116:5000/off"
    data =  {status:Status}
    
    	$.ajax({
            url: url,
            // dataType: 'json',
            type : "get",
            data:data,
            crossDomain: true,
            complete: function(xhr, statusText){
                console.log(xhr.responseText);
            },
            success: function(result) {
                alert('Like done');
            },
            error: function( req, status, err ) {
                alert('Error establecer conecxión');
            }
        });
    return false;
}