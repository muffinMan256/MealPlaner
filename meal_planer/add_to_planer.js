// add to meal planner

function addToPlaner(recipeId) {
    // show alert to choose a day
    Swal.fire({
        title: 'Select the day',
        input: 'select',
        inputOptions: {
            'Monday': 'Monday',
            'Tuesday': 'Tuesday',
            'Wednesday': 'Wednesday',
            'Thursday': 'Thursday',
            'Friday': 'Friday',
            'Saturday': 'Saturday',
            'Sunday': 'Sunday'
        },
        inputPlaceholder: 'Select a day',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value) {
                    resolve();
                } else {
                    resolve('You need to select a day');
                }
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Send the user to the server-side script with the selected day and recipeId
            window.location.href = 'meal_planer/add_to_planer.php?id=' + recipeId + '&week_day=' + result.value;
        }
    });
}
