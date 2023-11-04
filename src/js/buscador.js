document.addEventListener('DOMContentLoaded', () => {
    iniciarApp();
});

function iniciarApp() {
    buscarPorFecha();
}

function buscarPorFecha() {
   const fecha = document.querySelector('#fec_citasx');
   fecha.addEventListener('input', (e) => {
        const fechaSelecionada = e.target.value;
        window.location = `?fecha=${fechaSelecionada}`;
   });
}