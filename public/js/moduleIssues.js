// Function to show a notification
function showIssuesToast(message) {
    var successToast = `
        <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header">
                <strong class="me-auto">CaptionMe</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

    // Add the notification to the page
    $('.toast-container').append(successToast);

    // Show all notifications
    $('.toast').each(function () { 
        $(this).toast('show')
   });
}

// Function to detect module issues
function detectModuleIssues() {
    $.ajax({
        url: '/get-modules-issues',
        method: 'GET',
        success: function(response) {
            if (response.length > 0) {
                var moduleNames = response.map(function(module) {
                    return module.name;
                }).join(', ');

                showIssuesToast('<h5>Dysfonctionnements détectés</h5><span>Veuillez vérifier les modules suivants : <br>' + moduleNames + '</span>');
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

// Call the function to detect module issues when the page loads
$(document).ready(function() {
    detectModuleIssues();
});

// Update module issues every 5 minutes
setInterval(function() {
    detectModuleIssues();
}, 300000);
