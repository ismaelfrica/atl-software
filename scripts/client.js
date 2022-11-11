const obtaingData = (data)=>{
    id = (data.getAttribute('data-id')==0)? "": `?id=${data.getAttribute('data-id')}`;
    
    openToModal("client","Mantenimiento Cliente", `module/clients/client.php${id}`)
}

const viewMap = (data) =>{
    id       = data.getAttribute('data-id');
    idClient = data.getAttribute('data-client-id');
    loadIn("divClientResult",`module/clients/showmap.php?id=${id}&idClient=${idClient}`);
}

const deleteRow = (obj) =>{
    
    Swal.fire({
        title: 'Alerta de Usuario',
        text: "Desea eliminar este registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
          Swal.fire(
            'Alerta de Usuario!',
            'Registro Eliminado.',
            'success'
          )
        }
      })
}

const addRow = (data) =>{
        const divContainer = data.getAttribute('data-action');

        destino = document.getElementById(`${divContainer}`);
        console.log(destino)
        num = destino.childNodes.length;
        tr = document.createElement('tr');
        
        text = document.createElement('input');
        text.type='text';
        text.setAttribute('class','form-control');
        text.name = `txt${divContainer}[]`;
        text.id = `txt${divContainer}${num}`;
        text.value =  '';
        td = document.createElement('td');
        td.appendChild(text);
        tr.appendChild(td);

        
        text = document.createElement('a');
        text.href='javascript:void(0)';
        text.setAttribute('class','btn btn-danger');
        text.setAttribute('onclick','deleteRow(this);');
        text.id= 'txtEliminar`${num}';
        i = document.createElement('i');
        i.setAttribute('class','fa fa-trash');
        td = document.createElement('td');
        text.appendChild(i);
        td.appendChild(text);		
        tr.appendChild(td);
        
        destino.appendChild(tr);
     
        IMask(
            document.getElementById(`txt${divContainer}${num}`), {
              mask: '+{1}(000)000-0000'
            });
}

