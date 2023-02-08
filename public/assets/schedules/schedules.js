$(document).on("change", ".month-dropdown", function () {
    getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
});
$(document).on("change", ".year-dropdown", function () {
    getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
});