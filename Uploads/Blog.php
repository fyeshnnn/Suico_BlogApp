<?php include("uploads/database.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to My Blog</h1>
    <a href="controller/create.php" class="btn">+ New Post</a>
    <hr>

    <?php
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";

            if ($row['image']) {
                echo "<img src='uploads/" . $row['image'] . "' width='250'>";
            }

            echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
            echo "<p>" . nl2br(substr($row['content'], 0, 250)) . "...</p>";
            echo "<a href='controller/edit.php?id=" . $row['id'] . "'>Edit</a> | ";
            echo "<a href='controller/delete.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No blog posts yet. <a href='controller/create.php'>Create one</a>.</p>";
    }
    ?>
</body>
</html>
