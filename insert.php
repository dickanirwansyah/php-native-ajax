<?php
  if(isset($_POST["subject"])){
    $connect = mysqli_connect("localhost", "root", "root", "db_php");
    $subject = mysqli_real_escape_string($connect, $_POST["subject"]);
    $comment = mysqli_real_escape_string($connect, $_POST["comment"]);
    $status = mysqli_real_escape_string($connect, $_POST["status"]);

    $query = "
      INSERT INTO comment(comment_subject, comment_text, comment_status)
      VALUES('$subject', '$comment', $status)";

    mysqli_query($connect, $query);
  }
 ?>
