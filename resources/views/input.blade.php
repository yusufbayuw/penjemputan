<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penjemputan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa;
    }

    .container {
      text-align: center;
    }

    .form-label {
      margin-bottom: 10px;
      display: block;
    }

    .form-control {
      width: 300px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      box-sizing: border-box;
      outline: none;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
  </style>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <form id="myForm" method="post" action="/">
    <label for="focusedInput" class="form-label">Type Something:</label>
    <input type="text" class="form-control" name="focusedInput" id="focusedInput">
  </form>
</div>

<div class="container">
    <div class="table">

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Custom JavaScript -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Focus the input field when the page loads
    document.getElementById('focusedInput').focus();

    // Submit the form when Enter key is pressed
    document.getElementById('focusedInput').addEventListener('keyup', function(event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('myForm').submit();
      }
    });
  });
</script>

</body>
</html>
