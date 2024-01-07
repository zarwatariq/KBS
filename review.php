<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "user";
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review = mysqli_real_escape_string($conn, $_POST['users']);

    $sql = "INSERT INTO review (username, review) VALUES ('', '$review')";
    if (mysqli_query($conn, $sql)) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$result = mysqli_query($conn, "SELECT * FROM users");
$reviews = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = [
        'username' => $row['user_name'],
        'review' => $row['review']
    ];
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="review-page.css">
    <meta charset="UTF-8">
    <title>Review Page</title>
</head>
<body>
<div class="review-box">
    <form action="" method="post">
        <label for="review"></label>
        <textarea id="review" name="review" class="review-box"></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>

<div class="body">
    <p>reviews:</p>
    <div class="divider"></div>

    <?php
    foreach ($reviews as $review) {
        echo "<p>{$review['username']}:<br>{$review['review']}</p>";
    }
    ?>
</div>

<style>
    body {
        background-color: lightskyblue;
    }
</style>
</body>
</html>




