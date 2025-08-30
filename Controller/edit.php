<?php include("../Uploads/database.php");

$id = $_GET['id'];
$post = $conn->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $image = $post['image'];
    if ($_FILES['image']['name']) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
    }

    $sql = "UPDATE posts SET title='$title', content='$content', category='$category', image='$image' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Error updating: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Post</h1>
<form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data"
      onsubmit="return confirm('✅ Save changes to this post?');">
    <input type="text" name="title" value="<?php echo $post['title']; ?>" required><br>
    <textarea name="content" required><?php echo $post['content']; ?></textarea><br>
    <input type="text" name="category" value="<?php echo $post['category']; ?>" required><br>
    <input type="file" name="image"><br>
    <?php if($post['image']) { echo "<img src='../uploads/".$post['image']."' width='200'><br>"; } ?>
    <button type="submit" name="update">Update</button>
</form>
</body>

</body>
</html>
