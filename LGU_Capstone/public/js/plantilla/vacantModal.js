$(document).ready(function() {
    // Handle click event for Vacant Plantilla Item button
    $('#vacantButton').on('click', function() {
        // Open the Vacant Modal (if it's not already open)
        $('#vacantModal').modal('show');
        // Populate the Vacant Plantilla Items Table when the modal opens
        populateVacantPlantillaItems();
    });

    // Function to populate the vacant plantilla items table based on retired employees
    function populateVacantPlantillaItems() {
        var rowsToDisplay = [];

        // Loop through each row in the employee table to find retired employees
        $('#employeeTable .employee-data').each(function() {
            var remarks = $(this).data('remarks');
            var office = $(this).data('office');
            var position = $(this).find('td:eq(2)').text(); // Position
            var dob = $(this).find('td:eq(13)').text(); // Date of Birth
            var eligibleDate = calculateEligibilityDate(dob); // Date Eligible for Retirement

            // Check if the employee is retired (remarks can be used for this check)
            if (remarks.toLowerCase() === 'retired') {
                rowsToDisplay.push(`
                    <tr>
                        <td>${office}</td>
                        <td>${position}</td>
                        <td>
                            <!-- Action Button -->
                            <button class="btn btn-primary assign-btn" data-position="${position}" data-office="${office}" data-eligible-date="${eligibleDate}">
                                Take Action
                            </button>
                        </td>
                    </tr>
                `);
            }
        });

        // Update the table body with the rows of retired employees
        $('#vacantTableBody').html(rowsToDisplay.join(''));

        // Add click event to the "Take Action" button
        $('.assign-btn').on('click', function() {
            var office = $(this).data('office');
            var position = $(this).data('position');
            var eligibleDate = $(this).data('eligible-date');

            // Close the Vacant Modal
            $('#vacantModal').modal('hide');

            // Open the "Add Personnel" modal and pre-populate the form with relevant data
            $('#addPersonnelModal').modal('show');
            $('#addPersonnelModal #position').val(position);  // Pre-fill the position
            $('#addPersonnelModal #office').val(office);  // Pre-fill the office
            $('#addPersonnelModal #eligibleDate').val(eligibleDate);  // Pre-fill the eligibility date
        });
    }

    // Function to calculate eligibility date for retirement based on DOB
    function calculateEligibilityDate(dob) {
        var retirementAge = 60; // Adjust this based on your retirement policy
        var birthDate = new Date(dob);
        var eligibilityYear = birthDate.getFullYear() + retirementAge;

        // Create the date of eligibility in the Philippines timezone (UTC+8)
        var eligibilityDate = new Date(eligibilityYear, birthDate.getMonth(), birthDate.getDate());

        // Adjust for Philippines time zone (UTC+8) by setting the time to noon (12:00:00)
        eligibilityDate.setHours(12, 0, 0, 0);  // Noon to avoid time zone issues

        // Format the eligibility date as 'YYYY-MM-DD' (or another format)
        return eligibilityDate.toISOString().split('T')[0]; // Converts to 'YYYY-MM-DD' format
    }
});
