<!DOCTYPE html>
<html>
<head>
    <title>Card with Input Text Area</title>
    <style>
        /* CSS for card container */
        .card-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin-top: 50px;
        }
        /* CSS for card */
        .card {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
        /* CSS for input textarea */
        .card textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border: none;
            border-radius: 5px;
            resize: none;
            font-weight: bold;
        }
        /* CSS for save button */
        .card button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="card-container">
    <div class="card">
        <textarea placeholder="Enter text..." rows="5" cols="30"></textarea><br>
        <button>Save</button>
    </div>
</div>

</body>
</html>
