<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and trim inputs
    $serviceType = isset($_POST['service_type']) ? trim($_POST['service_type']) : '';
    $pickupDate = isset($_POST['pickup_date']) ? trim($_POST['pickup_date']) : '';
    $pickupTime = isset($_POST['pickup_time']) ? trim($_POST['pickup_time']) : '';
    $pickupLocation = isset($_POST['pickup_location']) ? trim($_POST['pickup_location']) : '';
    $dropoffLocation = isset($_POST['dropoff_location']) ? trim($_POST['dropoff_location']) : '';
    $passengers = isset($_POST['passengers']) ? trim($_POST['passengers']) : '';

    // Sanitize output for email content
    $serviceType = htmlspecialchars($serviceType, ENT_QUOTES, 'UTF-8');
    $pickupDate = htmlspecialchars($pickupDate, ENT_QUOTES, 'UTF-8');
    $pickupTime = htmlspecialchars($pickupTime, ENT_QUOTES, 'UTF-8');
    $pickupLocation = htmlspecialchars($pickupLocation, ENT_QUOTES, 'UTF-8');
    $dropoffLocation = htmlspecialchars($dropoffLocation, ENT_QUOTES, 'UTF-8');
    $passengers = htmlspecialchars($passengers, ENT_QUOTES, 'UTF-8');

    // Set recipient and subject
    $to = "ivanovicmicko4@gmail.com";  // Ensure this is a valid receiving email address
    $subject = "Nova rezervacija";

    // Construct message with proper newline characters
    $message = "Tip usluge: $serviceType\r\n" .
               "Datum preuzimanja: $pickupDate\r\n" .
               "Vreme preuzimanja: $pickupTime\r\n" .
               "Lokacija preuzimanja: $pickupLocation\r\n" .
               "Lokacija odlaska: $dropoffLocation\r\n" .
               "Broj putnika: $passengers\r\n";

    // Build headers. Use your server's domain for the From and Reply-To addresses.
    $fromEmail = "noreply@" . $_SERVER['SERVER_NAME'];
    $headers = "From: $fromEmail\r\n";
    $headers .= "Reply-To: $fromEmail\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Uspešno ste poslali rezervaciju.";
    } else {
        error_log("Email slanje nije uspelo. Headers: $headers; Poruka: $message");
        echo "Došlo je do greške. Pokušajte ponovo.";
    }
} else {
    echo "Nevažeći zahtev.";
}
?>
