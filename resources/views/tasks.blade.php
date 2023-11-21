<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Fields Project</title>
    <!-- Include Bootstrap CSS or any other styling framework you prefer -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Create Tasks</h2>

        @if (count($tasks) > 0)
            <h4 class="mt-md-5">Existing Tasks</h4>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Task Name</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->task_name }}</td>
                            <td>{{ $task->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h4 class="mt-md-5">Add New Tasks</h4>
        <form id="taskForm">
            @csrf
            <div class="form-group" id="taskContainer">
                <!-- Initial input field with Add button -->
                <div class="input-group mb-3">
                    <input type="text" name="tasks[]" class="form-control task-input" placeholder="Enter task">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success addTask">Add</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Display validation errors here -->
        <div id="errorsContainer" class="mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include your dynamic fields script here -->

    <!-- Your dynamic field script -->
    <script>
        $(document).ready(function() {
            // Set up AJAX globally
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Add dynamic input field
            $('#taskForm').on('click', '.addTask', function() {
                var inputField = '<div class="input-group mb-3">' +
                    '<input type="text" name="tasks[]" class="form-control task-input" placeholder="Enter task">' +
                    '<div class="input-group-append">' +
                    '<button type="button" class="btn btn-danger removeTask">Remove</button>' +
                    '</div>' +
                    '</div>';

                $('#taskContainer').append(inputField);
            });

            // Remove dynamic input field
            $('#taskContainer').on('click', '.removeTask', function() {
                $(this).closest('.input-group').remove();
            });

            // Submit form with Ajax
            $('#taskForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/tasks',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle success
                        console.log(response);
                    },
                    error: function(error) {
                        // Handle error and display validation messages
                        var errors = error.responseJSON.errors;
                        var errorMessage = error.responseJSON.message;

                        $('.task-input').removeClass('is-invalid');
                        $('.invalid-feedback').remove();

                        // Clear previous errors in the errors container
                        $('#errorsContainer').empty();

                        if (errorMessage) {
                            // Display the general error message
                            $('#errorsContainer').append(
                                '<div class="alert alert-danger">' + errorMessage + '</div>'
                            );
                        } else if (errors) {
                            // Display validation errors
                            $.each(errors, function(field, messages) {
                                $('[name="' + field + '"]').addClass('is-invalid');
                                $('#errorsContainer').append(
                                    '<span class="invalid-feedback">' + messages[
                                        0] + '</span>'
                                );
                            });
                        }
                    }
                });
            });
        });
    </script>

    <!-- Include Bootstrap JS or any other scripting framework you prefer -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
