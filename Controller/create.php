<?php include("../Uploads/database.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Create a New Post</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Write your article..." required></textarea><br>
        <input type="text" name="category" placeholder="Category" required><br>
        <input type="file" name="image"><br>
        <button type="submit" name="submit">Post</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        $image = "";
        if ($_FILES['image']['name']) {
            $image = time() . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
        }

        $sql = "INSERT INTO posts (title, content, category, image) VALUES ('$title','$content','$category','$image')";
        if ($conn->query($sql)) {
            header("Location: index.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>
