function ismaelfricaFormValUpdate(formulario, receptor)
{
	
		$.ajax({
            type: 'POST',
            url: formulario.attr('action'),
			 beforeSend: function(objeto){
				receptor.html("<center><img style='margin: 0 auto;' src='images/pleasewait.gif'/></center>");
				//alert(formulario.serialize());
			},

            data: formulario.serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
				
				receptor.html(data);
            }
        });       
}

function formsubmit(formulario, receptor)
{
	
	formulario.bind("submit", function(e){
		mensaje = "Faltan campos necesarios para continuar: \n";
		mostrarMSG = false;
		if (typeof filters == 'undefined') return;
	    $(this).find("input, textarea, select").each(function(x,el){ 
	        if ($(el).attr("className") != 'undefined') { 
		$(el).removeClass("error");
	        $.each(new String($(el).attr("className")).split(" "), function(x, klass){
	            if ($.isFunction(filters[klass]))
	                if (!filters[klass](el))  
					{
						$(el).addClass("error");
						//alert(el.id);
						if($(el).attr("title") != "")
						{
							mensaje += " - " + $(el).attr("title")+ "\n";
							mostrarMSG = true;
						}
					}
	        });
	        }
	    });
		
	    $.ajax({
            type: 'POST',
            url: formulario.attr('action'),
			 beforeSend: function(objeto){
				receptor.html("<center><img style='margin: 0 auto;' src='images/pleasewait.gif'/></center>");
			},
            data: formulario.serialize(),
            success: function(data) {
				
				receptor.html(data);
            }
        })        
        return false;
	});	
	
}

const filters = {
            requerido: function(el) {return ($(el).val() != '' && $(el).val() != -1);},
            email: function(el) {return /^[A-Za-z.+][A-Za-z0-9_.+]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/.test($(el).val());},
            telefono: function(el){return /^[0-9]*$/.test($(el).val());},

            entero: function(el){return /^[0-9]*$/.test($(el).val());},
            decimal: function(el){return /^[-]?([1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|\.[0-9]{1,2})$/.test($(el).val());},
            ceduladom: function(el){return verificarCedula($(el).val());},
            fechamysql: function(el){return validarFecha($(el).val());}
			
		};

function loadIn(elemento, pagina, datos)
{
    //verificarConexion();
    $.ajax({
        type: 'GET',
        url: pagina,
            beforeSend: function(objeto){
        $("#"+elemento).html("<center><img style='margin: 0 auto; width:150px;height:150px;' src='images/pleasewait.gif'/></center>");
            //alert(formulario.serialize());
        },
        data: datos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
        //	$("#"+elemento).hide();
            $("#"+elemento).html(data);
        //	$("#"+elemento).show('highlight', {},1000,''  );
            
        }
    }) ;	
}

function openToModal(idModal,title, page)

{
    valor = "modal-lg";
    if(!$('#'+idModal).html()){
        newHTML = document.createElement ('div');
    
    newHTML.innerHTML = `
        <div class="modal fade" id="${idModal}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">${title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body" id="dCs${idModal}">
                        
                    </div>
                </div>
            </div>
        </div>
    
    `;
    document.body.appendChild (newHTML);          
    }
    $('#'+idModal).modal('show');
    loadIn('dCs'+idModal, page, "");

}