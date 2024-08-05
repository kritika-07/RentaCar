"use strict";

document.getElementById('start_date').addEventListener('input', function() {
    var days = parseInt(document.getElementById('days').value);
    var startDate = new Date(this.value);
    if (!isNaN(startDate.getTime()) && !isNaN(days)) {
        var endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + days);
        document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
    }
});

document.getElementById('days').addEventListener('input', function() {
    var days = parseInt(this.value);
    var startDate = new Date(document.getElementById('start_date').value);
    if (!isNaN(startDate.getTime()) && !isNaN(days)) {
        var endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + days);
        document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
    }
});
