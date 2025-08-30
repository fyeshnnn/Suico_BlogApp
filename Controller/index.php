<?php include("../Uploads/database.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Suico's Blog System</title>
  <link rel="stylesheet" href="/BlogApp/Controller/style.css">
</head>
<body>
  <h1>🌸 Bloom Board Blog 🌸</h1>
  <a class="btn" href="/BlogApp/Controller/create.php">+ New Post</a>
  <div class="posts">
    <?php
      $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
      while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>
                <h2>".htmlspecialchars($row['title'])."</h2>
                <p><b>Category:</b> ".htmlspecialchars($row['category'])."</p>";
        if (!empty($row['image'])) {
          echo "<img src='/BlogApp/uploads/".htmlspecialchars($row['image'])."' width='200'>";
        }
        echo "<p>".nl2br(htmlspecialchars($row['content']))."</p>
        <a class='btn edit' href='edit.php?id=".$row['id']."' onclick=\"return confirm('✏️ Do you want to update this post?');\">Edit</a>
        <a class='btn delete' href='delete.php?id=".$row['id']."' onclick=\"return confirm('🗑️ Are you sure you want to delete this post?');\">Delete</a>
        </div>";
      }
    ?>
  </div>
</body>
</html>
