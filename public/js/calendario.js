document.onload

class Calendario {

    static invalidDateMessage = 'El formato es incorrecto';

    constructor(id, notifier) {
        this.id = id;
        this.notifier = notifier;
    }

    getCalendarHtmlElement() {
        return document.getElementById(this.id);
    }

    async fetchCalendar(date1, date2, columns) {
        var details = {
            'fecha_inicio': date1,
            'fecha_fin': date2,
            'columns': columns,
        };

        var formBody = [];

        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");

        const response = await fetch(window.location.href, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formBody,
        });
        return response.text();
    }

    async buildNewCalendar(date1, date2, columns) {

        try {
            let htmlCalendar = await this.fetchCalendar(date1, date2, columns);
            this.getCalendarHtmlElement().innerHTML = '';
            this.getCalendarHtmlElement().innerHTML = htmlCalendar;
        } catch (error) {
            console.error(error);
            this.notifier.notify('Ocurrió un error al procesar tu solicitud');
        }

    }

    static validateDate(date) {
        let error = '';
        let DateRegx = /^(1[0-2]|0[1-9])\-[0-9]{4}$/;
        let dateIsValid = DateRegx.test(date);

        if(!dateIsValid){
            error = 'Ingresa una fecha valida\n\n MM-AAAA'
        }

        return error;
    }

    static validateDates(startDate, endDate) {
        let error = '';

        let _startDate = Calendario.stringDateToDateType(startDate);
        let _endDate = Calendario.stringDateToDateType(endDate);

        if(_startDate > _endDate){
            error = 'La fecha fin debe ser mayor a la fecha inicio'
        }
        return error;
    }

    static stringDateToDateType(date){
        let startDateMonthAndYear = date.split('-');
        return new Date(startDateMonthAndYear[1], startDateMonthAndYear[0]);
    }
}