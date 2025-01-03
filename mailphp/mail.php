<?php
// Initialize variables
$thankYouMessage = "";
$redirect = false;

// Form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent XSS attacks
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $age = htmlspecialchars(trim($_POST['age']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $service = htmlspecialchars(trim($_POST['service']));

    // Email recipient
    $to = "your-email@example.com"; // Replace with your email address
    $subject = "New Consultancy Form Submission";

    // Email content
    $message = "You have received a new consultancy form submission.\n\n";
    $message .= "Full Name: " . $name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Phone: " . $phone . "\n";
    $message .= "Age: " . $age . "\n";
    $message .= "Gender: " . $gender . "\n";
    $message .= "Service Requested: " . $service . "\n";

    // Email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        // Success: Set the Thank You message and trigger redirect
        $thankYouMessage = "Thank you for your submission! We will get back to you soon.";
        $redirect = true;
    } else {
        // Failure: Show error message
        $thankYouMessage = "An error occurred while sending the email. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultancy Form Submission</title>
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
        <form method="post" action="process-form.php" id="consultancy-form" novalidate>
            <div class="row">
                <div class="form-field col-lg-6">
                    <input class="form-control-name" type="text" placeholder="Full Name" name="name" id="name" required>
                </div>
                <div class="form-field col-lg-6">
                    <input class="form-control-mail" type="email" placeholder="Email" name="email" id="email" required>
                </div>
                <div class="form-field col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <input class="form-controls form-control-number" name="phone" type="tel" placeholder="Phone No." required>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="form-control-age col-lg-6">
                                    <select name="age" class="form-control" required>
                                        <option value="0" disabled selected>Age</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                    </select>
                                </div>
                                <div class="form-controls form-control-gender col-lg-6">
                                    <select name="gender" class="form-control" required>
                                        <option value="0" disabled selected>Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-controls form-control-choose-department">
                    <select name="service" class="form-control" required>
                        <option value="0" disabled selected>Choose Service</option>
                        <option value="Fertility Consultation">Fertility Consultation</option>
                        <option value="Ovulation Induction">Ovulation Induction</option>
                        <option value="In Vitro Fertilization (IVF)">In Vitro Fertilization (IVF)</option>
                    </select>
                </div>
                <div class="col-xl-6 col-lg-12 col-12">
                    <div class="submit-area">
                        <button type="submit" class="theme-btn">Book Appointment</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
