<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Modal with PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .modal-content {
            text-align: center;
        }

        .modal-body button {
            margin-bottom: 10px;

        }

        .btn {
            padding-left: 34px;
            padding-right: 34px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Setting</button>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Options</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button onclick="window.location.href = 'edit_or_delete.php';" class="btn btn-primary" type="button">Button</button>
                        <button onclick="window.location.href = 'edit_or_delete.php';" class="btn btn-primary" type="button">Button</button>
                        <button onclick="window.location.href = 'edit_or_delete.php';" class="btn btn-primary" type="button">Button</button>
                        <button onclick="window.location.href = 'logout.php';" class="btn btn-primary" type="button">logout</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>