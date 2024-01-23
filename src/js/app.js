let paso = 1;
const inicio = 1;
const final = 3;

const citas = {
    id: '',
    nombre: '',
    fecha: '',
    servicios: []
};

document.addEventListener('DOMContentLoaded',() =>{
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion(); 
    tabs();
    botonesPaginador();
    paginaAnterior();
    paginaSiguiente();

    consultarApi();

    nombrecliente();
    idCliente();
    seleccionarFecha();
    seleccionarHora();
}

function mostrarSeccion(){

    //ocultar sección anterior
    if(document.querySelector('.mostrar')){
        document.querySelector('.mostrar').classList.remove('mostrar');
    }
    const pasoSelector = `#paso-${paso}`;
   
    const seccion = document.querySelector(pasoSelector);

    seccion.classList.add('mostrar');

    //borramos la clase de actual de tab anterior
    const tabAnterior = document.querySelector('.actual')
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //resaltar opcion actual
    const tab = document.querySelector(`[data-paso="${paso}"]`)
    tab.classList.add('actual');
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', (e) => {
            paso = parseInt(e.target.dataset.paso);

            mostrarSeccion();

            botonesPaginador();
        });
    })
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
        mostrarResumen();
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');

    paginaAnterior.addEventListener('click', () =>{
        if(paso <= inicio) return;

        paso--;

        botonesPaginador();
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');

    paginaSiguiente.addEventListener('click', () =>{
        if(paso >= final) return;

        paso++;

        botonesPaginador();
    })
}

async function consultarApi() {

    try {
        const url = '/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach( servicio => {
        const {id, nom_servic, val_servic} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nom_servic;

        const valorServicio = document.createElement('P');
        valorServicio.classList.add('valor-servicio');
        valorServicio.textContent = `$${val_servic}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(valorServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);

    })
}

function seleccionarServicio(servicio) {
    const {id} = servicio;
    const {servicios} = citas;

    const seleccionado = document.querySelector(`[data-id-servicio="${id}"]`)
    if( servicios.some(agregado => agregado.id === id) ){
        //eliminar porque se esta dando click por segunda vez
        citas.servicios = servicios.filter( agregado => agregado.id !== id);
        seleccionado.classList.remove('seleccionado');
    } else {
        citas.servicios = [...servicios, servicio]
        seleccionado.classList.add('seleccionado');
    }
}

function nombrecliente() {
    citas.nombre = document.querySelector('#nom_usuari').value;
}

function idCliente() {
    citas.id = document.querySelector('#usu_citasx').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fec_citaxx');
    inputFecha.addEventListener('input', e =>{
        const dia = new Date(e.target.value).getUTCDay();
        if( [6,0].includes(dia) ){
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
        } else {
            citas.fecha = e.target.value;
        }
    });
}

function seleccionarHora() { 
    const inputHora = document.querySelector('#hor_citaxx');
    inputHora.addEventListener('input', e =>{
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if( hora < 8 || hora > 18 ){
            e.target.value = '';
            mostrarAlerta('Hora fuera de horario laboral', 'error', '.formulario');
        } else {
            citas.hora = e.target.value;
        }
    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparecer = true) {
    const alertaPrevia = document.querySelector('alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    }

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const formulario = document.querySelector(elemento);
    formulario.appendChild(alerta);
    if(desaparecer){
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}

function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');
    //Limpia el contenido de Resumen
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }
    if(Object.values(citas).includes('') || citas.servicios.length === 0) {
        mostrarAlerta('Faltan datos y/o servicios elegidos', 'error', ".contenido-resumen", false)
        return;
    }
    
    const { nombre, fecha, hora, servicios } = citas;
    
    //Heading para servicios en resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de servicios';
    resumen.appendChild(headingServicios);
    //iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const {id, nom_servic, val_servic} = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nom_servic;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${val_servic}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    //Heading para servicios en resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de cita';
    resumen.appendChild(headingCita);
    
    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;
    
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate();
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
    const fechaFormateada = fechaUTC.toLocaleDateString('es-CO', opciones);
    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;
    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;
    
    const botonCita = document.createElement('BUTTON');
    botonCita.classList.add('button');
    botonCita.textContent = 'Reservar Cita';
    botonCita.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonCita);

}

async function reservarCita() {

    const { id, nombre, fecha, hora, servicios } = citas;

    const idServicios = servicios.map( servicio => servicio.id ) 

    const datos = new FormData();
    datos.append('usu_citasx', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idServicios);

    // console.log([...datos]);
    try {
        //petición hacia la api
        const url = '/api/citas';

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado);
        if(resultado.resultado){
            Swal.fire({
                icon: 'success',
                title: 'Exito',
                text: 'Cita creada correctamente!',
            }).then( () => {
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al crear la cita '+error,
        })
    }

}
