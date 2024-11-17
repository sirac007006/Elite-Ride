<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $serviceType = htmlspecialchars($_POST['service_type']);
    $pickupDate = htmlspecialchars($_POST['pickup_date']);
    $pickupTime = htmlspecialchars($_POST['pickup_time']);
    $pickupLocation = htmlspecialchars($_POST['pickup_location']);
    $dropoffLocation = htmlspecialchars($_POST['dropoff_location']);
    $passengers = htmlspecialchars($_POST['passengers']);

    $to = "ivanovicmicko4@gmail.com"; // Unesite svoju email adresu
    $subject = "Nova rezervacija";
    $message = "
    Tip usluge: $serviceType\n
    Datum preuzimanja: $pickupDate\n
    Vreme preuzimanja: $pickupTime\n
    Lokacija preuzimanja: $pickupLocation\n
    Lokacija odlaska: $dropoffLocation\n
    Broj putnika: $passengers
    ";
    $headers = "From: noreply@yourdomain.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Uspešno ste poslali rezervaciju.";
    } else {
        echo "Došlo je do greške. Pokušajte ponovo.";
    }
} else {
    echo "Nevažeći zahtev.";
}
?>