<?php
require_once('connection.php');

// Initialize variables for filtering and searching
$category = "";
$location = "";
$search = "";

// Check if filter or search parameters were submitted
if (isset($_POST['filter'])) {
    $category = $_POST['category'];
    $location = $_POST['location'];
} elseif (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Build SQL query based on filter and search parameters
$sql = "SELECT * FROM blogpost WHERE 1=1";
if (!empty($category)) {
    $sql .= " AND category='$category'";
}
if (!empty($location)) {
    $sql .= " AND location='$location'";
}
if (!empty($search)) {
    $sql .= " AND (title LIKE '%$search%' OR location LIKE '%$search%' OR category LIKE '%$search%')";
}

// Execute query
$result = mysqli_query($conn, $sql);
// Check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Display blog posts in grid column layout
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="col-">';
    echo '<div class="card shadow">';
    echo '<img src="' . $row['main_image'] . '" class="card-img-top" alt="' . $row['title'] . '" style="max-height:200px">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $row['title'] . '</h5>';
    echo '<div class="card-text" style="max-height:50px;overflow:hidden">' . $row['content'] . '</div>';
    echo '<p class="card-text"><small class="text-muted">' . date('M j, Y', strtotime($row['created'])) . '</small></p>';
    echo '<a href="blog-details.php?postid=' . $row['id'] . '" class="btn btn-primary">Read More</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

// Close database connection
mysqli_close($conn);
?>
