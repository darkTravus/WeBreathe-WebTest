//module.js
$(document).ready(function() {
    // Function to fetch and update module status
    function fetchModuleStatus(moduleId) {
        $.ajax({
            url: '/get-module-status/' + moduleId,
            method: 'GET',
            success: function(response) {
                // Update module status on the page
                var statusDotColor;
                switch (response.status) {
                    case 'Operationaly':
                        statusDotColor = 'green';
                        break;
                    case 'Repair':
                        statusDotColor = 'orange';
                        break;
                    case 'Faulty':
                        statusDotColor = 'red';
                        break;
                    default:
                        statusDotColor = 'black';
                }
                var $moduleStatus = $('#moduleStatus');
                $moduleStatus.html("Statut : " + response.status + ' <span class="status-dot"></span>');
                $('.status-dot', $moduleStatus).css('background-color', statusDotColor);
                
                $('#moduleEntity').text("Entité : " + response.entity);
                $('#moduleDescription').text("Description : " + response.description);

                var updatedAt = new Date(response.updated_at).toISOString();

                // Get the date to YYYY-MM-JJ HH:MM:SS
                var formattedDate = updatedAt.slice(0, 10);
                var formattedTime = updatedAt.slice(11, 19);
                var formattedDateTime = formattedDate + ' ' + formattedTime;

                $('#moduleUpdate').text("Mis à jour le : " + formattedDateTime);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Call the function to fetch initial data when the page loads
    fetchModuleStatus(moduleId);

    // Update moodule data every minute
    setInterval(function() {
        fetchModuleStatus(moduleId);
    }, 60000);

    // Function to fetch and update module history data based on filters
    function fetchModuleHistory(moduleId, dateFilter, timeFilter) {
        $.ajax({
            url: '/get-module-history/' + moduleId,
            method: 'GET',
            data: {
                date: dateFilter,
                time: timeFilter
            },
            success: function(response) {
                updateChart(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Default values for filters
    var currentDate = new Date().toISOString().slice(0, 10);
    var currentTime = new Date().toISOString().slice(11, 16);
    $('#dateFilter').val(currentDate);
    $('#timeFilter').val(currentTime);

    // Define charts
    var ctxTemperature = document.getElementById('temperatureChart').getContext('2d');
    var temperatureChart = new Chart(ctxTemperature, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Temperature',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxPassenger = document.getElementById('passengerChart').getContext('2d');
    var passengerChart = new Chart(ctxPassenger, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Passengers Boarded',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }, {
                label: 'Passengers Alighted',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxTotalPassenger = document.getElementById('totalPassengerChart').getContext('2d');
    var totalPassengerChart = new Chart(ctxTotalPassenger, {
        type: 'line',
        data: {
            datasets: [{
                    label: 'Total Passengers',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
            },]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxDistance = document.getElementById('distanceChart').getContext('2d');
    var distanceChart = new Chart(ctxDistance, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Distance Covered',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fetch initial history data
    fetchModuleHistory(moduleId, currentDate, currentTime);

    // Update data every 30 seconds
    setInterval(function() {
        fetchModuleHistory(moduleId, currentDate, currentTime);
    }, 30000);

    // Function to update charts with new data and summary table
    function updateChart(data) {
        // Update temperature chart
        var temperatures = [];
        var timestamps = [];
        var boardedPassengers = [];
        var alightedPassengers = [];
        var totalPassengers = [];
        var distances = [];

        data.forEach(function(entry) {
            // Update temperature chart data
            temperatures.push(entry.temperature_value);
            var formattedTimestamp = new Date(entry.created_at).toISOString().slice(11, 19);
            timestamps.push(formattedTimestamp);

            // Update passenger data for summary table
            boardedPassengers.push(entry.boarding_passenger_count);
            alightedPassengers.push(entry.alighting_passenger_count);
            totalPassengers.push(entry.total_passenger_count);

            // Update distance data for summary table
            distances.push(entry.distance_traveled);
        });

        // Update temperature chart
        temperatureChart.data.labels = timestamps;
        temperatureChart.data.datasets[0].data = temperatures;

        // Update passenger chart
        passengerChart.data.labels = timestamps;
        passengerChart.data.datasets[0].data = boardedPassengers;
        passengerChart.data.datasets[1].data = alightedPassengers;

        // Update total passengers chart
        totalPassengerChart.data.labels = timestamps;
        totalPassengerChart.data.datasets[0].data = totalPassengers;

        // Update distance chart
        distanceChart.data.labels = timestamps;
        distanceChart.data.datasets[0].data = distances;

        // Update all charts
        temperatureChart.update();
        passengerChart.update();
        totalPassengerChart.update();
        distanceChart.update();

        // Update summary table
        updateSummaryTable(temperatures, boardedPassengers, alightedPassengers, totalPassengers, distances);
    }

    // Function to update summary table
    function updateSummaryTable(temperatures, boardedPassengers, alightedPassengers, totalPassengers, distances) {
        // Calculate average temperature
        var sumTemperature = temperatures.reduce((acc, curr) => acc + curr, 0);
        var averageTemperature = (sumTemperature / temperatures.length).toFixed(2);
        $('#averageTemperature').text(averageTemperature);

        // Calculate average boarded passengers
        var sumBoardedPassengers = boardedPassengers.reduce((acc, curr) => acc + curr, 0);
        var averageBoardedPassengers = (sumBoardedPassengers / boardedPassengers.length).toFixed(2);
        $('#averagePassenger').text(averageBoardedPassengers);

        // Calculate max and min boarded passengers
        var maxBoardedPassengers = Math.max(...boardedPassengers);
        var minBoardedPassengers = Math.min(...boardedPassengers);
        $('#maxPassenger').text(maxBoardedPassengers);
        $('#minPassenger').text(minBoardedPassengers);

        // Calculate total passengers
        var sumTotalPassengers = totalPassengers.reduce((acc, curr) => acc + curr, 0);
        $('#totalPassenger').text(sumTotalPassengers);

        // Calculate total distance traveled
        var sumDistances = distances.reduce((acc, curr) => acc + curr, 0);
        $('#totalDistance').text(sumDistances);
    }


    // Event handler for date filter change
    $('#dateFilter').on('change', function() {
        currentDate = $(this).val();
        fetchModuleHistory(moduleId, currentDate, currentTime);
        updateSummaryTitle(currentDate, currentTime);
    });

    // Event handler for time filter change
    $('#timeFilter').on('change', function() {
        currentTime = $(this).val();
        fetchModuleHistory(moduleId, currentDate, currentTime);
        updateSummaryTitle(currentDate, currentTime);
    });

});

// Function to update the summary title based on date and time filters
function updateSummaryTitle(date, time) {
    var formattedDate = formatDate(date);
    var formattedTime = formatTime(time);
    var summaryTitle = `Récapitulatif du ${formattedDate} de ${formattedTime[0]} à ${formattedTime[1]}`;
    $('#table-title').text(summaryTitle);
}

// Function to format date as YYYY/MM/DD
function formatDate(date) {
    var parts = date.split('-');
    return parts[2] + '/' + parts[1] + '/' + parts[0];
}

// Function to format time as HH:MM
function formatTime(time) {
    var parts = time.split(':');
    var hours = parseInt(parts[0]);
    var minutes = parseInt(parts[1]);
    var endTime = (hours === 23 && minutes === 59) ? '00:00' : (hours + 1) + ':' + parts[1];
    return [time, endTime];
}