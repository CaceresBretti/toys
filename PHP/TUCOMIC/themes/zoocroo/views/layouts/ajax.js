function buscar() {
	/*consulta = "consulta";
        query = document.getElementById(consulta).value;
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                console.log(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET","index.php?r=site/page&view=buscador&consulta="+query,true);
        xmlhttp.send();*/
	consulta = "consulta";
        query = document.getElementById(consulta).value;
	if (query != "")
		window.location = "index.php?r=site/page&view=buscador&consulta="+query;
}

function busquedaAvanzada() {
        vars =['nombre','saga','numero','editorial','escritor','dibujante','genero','idioma','desde','hasta','estado'];
        var sel = document.getElementById(vars[10]);
        var aux = sel.options[sel.selectedIndex].value;
        if (aux == "compra")
            aux = 1;
        else if (aux == "venta")
            aux = 2;
        else if (aux == "reserva")
            aux = 3;
        query = document.getElementById(vars[0]).value + "!" + document.getElementById(vars[1]).value + "!" + document.getElementById(vars[2]).value + "!" + document.getElementById(vars[3]).value + "!" + document.getElementById(vars[4]).value + "!" + document.getElementById(vars[5]).value + "!" + document.getElementById(vars[6]).value + "!" + document.getElementById(vars[7]).value + "!" + document.getElementById(vars[8]).value + "!" + document.getElementById(vars[9]).value + "!" + aux;
        window.location = "index.php?r=site/page&view=resultados&consulta="+query;

        
        
}

