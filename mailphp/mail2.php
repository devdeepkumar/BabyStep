<?php
// Initialize variables
$thankYouMessage = "";
$redirect = false;

// Form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent XSS attacks
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    // Here you can write your code to send email or store data in the database
    // For now, we simulate success
    $thankYouMessage = "Thank you for your request! We will get back to you soon.";
    $redirect = true;  // To display the thank you page
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Call Back</title>
    <style>
        /* Basic reset for body */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            text-align: center;
        }

        /* Centering the Thank You message */
        .thank-you-container {
            background-color: #ffffff;
            border: 2px solid #ddd;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .thank-you-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .thank-you-container p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        .btn.exit {
            background-color: #f44336;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Hide the form when the thank you message is displayed */
        .form-container {
            display: <?php echo $thankYouMessage == "" ? 'block' : 'none'; ?>;
        }

        .thank-you-container {
            display: <?php echo $thankYouMessage != "" ? 'block' : 'none'; ?>;
        }
    </style>

    <script>
        // Redirect to the homepage if the user doesn't click any button within 5 seconds
        setTimeout(function() {
            window.location.href = "index.html"; // Change this to your homepage URL
        }, 5000); // Redirect after 5 seconds
    </script>
</head>
<body>

<?php if ($thankYouMessage != ""): ?>
    <div class="thank-you-container">
        <h1>Thank You!</h1>
        <p><?php echo $thankYouMessage; ?></p>
        <button class="btn" onclick="window.location.href='index.html'">Back to Home</button>
        <button class="btn exit" onclick="window.location.href='exit.html'">Exit</button>
    </div>
<?php else: ?>
    <div class="form-container">
        <form method="post" action="process-call-back.php" id="call-back-form" novalidate>
            <div class="input-1">
                <input type="text" class="form-control" placeholder="Enter Name*" name="name" required>
            </div>
            <div class="input-1">
                <input type="text" class="form-control" placeholder="Enter Phone*" name="phone" required>
            </div>
            <div class="submit clearfix">
                <button type="submit">Request Call Back</button>
            </div>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
