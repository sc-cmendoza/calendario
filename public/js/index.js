document.addEventListener('DOMContentLoaded', async () => {

    let notifier = new Notifier();
    let calendar = new Calendario('calendario', notifier);

    let form = document.getElementById('form');
    let inputFechaInicio = document.getElementById('fecha_inicio');
    let inputFechaFin = document.getElementById('fecha_fin');
    let inputcolumns = document.getElementById('columns');

    inputFechaInicio.addEventListener('input', () => {
        inputFechaInicio.setCustomValidity('');
    });

    inputFechaFin.addEventListener('input', () => {
        inputFechaFin.setCustomValidity('');
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        inputFechaInicio.setCustomValidity(Calendario.validateDate(inputFechaInicio.value));
        inputFechaFin.setCustomValidity(Calendario.validateDate(inputFechaFin.value));

        if (inputFechaFin.checkValidity()) {
            inputFechaFin.setCustomValidity(Calendario.validateDates(inputFechaInicio.value, inputFechaFin.value));
        }

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        calendar.buildNewCalendar(inputFechaInicio.value, inputFechaFin.value, inputcolumns.value);

    });

});