$('document').ready(function (){
	numpage=parseInt($('#numpage').val());
    totalpage= parseInt($('#tpage').val());
	
	$('#next').click(function() {
		post('index.php',	{page: numpage+1});
	});

	$('#back').click(function() {
		post('index.php',	{page: numpage-1});
	});
    //comprobar si se esta en la primera pagina
	if(numpage>1){
		$('#back').show();
	}
	else{
		$('#back').hide();
	}
    //comprobar si se esta en la ultima pagina
    if(numpage == totalpage)
    {
        $("#next").prop('disabled', true);
    }else{
        $("#next").prop('disabled', false);
    }
    
});


//funcion para enviar la solicitud de paginas
function post(path, params, method) {
    method = method || "post";
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}
