// Function to show a success notification
function showSuccessToast(message) {
    var successToast = `
    <div id="message" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    `;

    // Add the notification to the page
    $('body').append(successToast);

    // Show the toast with a fade-in animation
    $('#message .toast').addClass('show');

    // Add event listener to close button
    $('#message .btn-close').on('click', function() {
        // Remove the toast element from the page
        $('#message').remove();
    });
}
// Function to detect module issues
function detectModuleIssues() {
    $.ajax({
        url: '/get-modules-issues', // Make sure the URL matches your route
        method: 'GET',
        success: function(response) {
            if (response.length > 0) {
                var moduleNames = response.map(function(module) {
                    return module.name;
                }).join(', ');

                // Show a success notification with the names of the non-operational modules
                showSuccessToast('Des dysfonctionnements ont été détectés. Veuillez vérifier les modules suivants : <br>' + moduleNames);
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
