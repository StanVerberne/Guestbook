<?php include 'inc/connection.php'?>
<?php
    if (isset($_POST['mySubmit'])) {
        // someone clicked the submit button
        // define SQL string
        $insertSQL =
      "INSERT INTO
      `guestbook`
      (
      `guestbookId`,
      `firstname`,
      `insertion`,
      `lastname`,
      `email`,
      `websiteAddress`,
      `messageTitle`,
      `message`,
      `messageDate`
    )
      VALUES
      (
      null,
      '" . $_POST['firstname'] . "',
      '" . $_POST['insertion'] . "',
      '" . $_POST['lastname'] . "',
      '" . $_POST['email'] . "',
      '" . $_POST['websiteAddress'] . "',
      '" . $_POST['messageTitle'] . "',
      '" . $_POST['message'] . "',
            NOW()
      )
      ";

      if(!empty($_POST['firstname']) && (!empty($_POST['lastname'])) && (!empty($_POST['email'])) ) {


        $result1 = $conn->query($insertSQL) or die($conn->error);

        echo '<script language="javascript">';
        echo 'alert("Thanks for your post !")';
        echo '</script>';
      }
    }

$selectReviewsQuery = "SELECT * FROM guestbook";

$reviews    = array();
$resource    = mysqli_query($conn, $selectReviewsQuery) or die(mysqli_error($conn));
while ($row    = mysqli_fetch_assoc($resource)) {
    // add items to the array
    $reviews[] = $row;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Guestbook</title>
    <meta name="author" content="Stan Verberne"/>
    <meta name="keywords" content="Guestbook, ROC Ter AA, PHP, HTML, WD"/>
    <meta name="description" content="Example of a guestbook as used in lessons for ROC Ter AA.
    Fetch from databse user posts."/>
    <meta name="copyright" content="text">
  </head>
  <body>
    <header id="main-header"><h4>Guestbook<h4></header>
    <div id="main-container">
    <div id="review-Form">
      Review Form:
    </div>
    <div id="main-container-form">
    <form action="index.php" method="post">
      <input type="hidden" name="guestbookId" value="<?php echo['guestbookId'] ?>"/>
      <table width="500">
        <tr><td>
      <div id="firstname-container">
      <label for="firstname" id="firstname-header">
      *  Firstname:
      </label></td><td>
      <input type="text" placeholder="Your firstname" name="firstname" id="firstname"/>
    <?php  if (empty($_POST['firstname']))
     {
         echo "Firstname isn't filled in";
     }?>
    </div></td></tr>
    <tr><td>

  <div id="insertion-container">
  <label for="insertion" id="insertion-header">
    Insertion:
  </label></td><td>
  <input type="text" placeholder="Your insertion" name="insertion" id="insertion"/>
</div></td>
  </tr>
  <tr><td>
  <div id="lastname-container">
    <label for="lastname" id="lastname-header">
    *  Lastname:
    </label></td><td>
    <input type="text" placeholder="Your lastname" name="lastname" id="lastname"/>
    <?php  if (empty($_POST['lastname']))
     {
         echo "Lastname isn't filled in";
     }?>
  </div></td></tr>
  <tr><td>
  <div id="email-container">
    <label for="email" id="email-header">
    *  E-mail:
    </label></td><td>
    <input type="email" placeholder="Your email" name="email" id="email"/>
    <?php  if (empty($_POST['email']))
     {
         echo "E-mail isn't filled in";
     }?>
  </div></td></tr>
  <tr><td>
    <div id="websiteAddress-container">
    <label for="websiteAddress" id="websiteAddress-header">
    *  Website-Address:
    </label></td>
    <td>
    <input type="text" placeholder="Your Website" name="websiteAddress" id="websiteAddress"/>
    <?php  if (empty($_POST['websiteAddress']))
     {
         echo "Website Address isn't filled in";
     }?>
  </td>
</div></tr>
<tr><td>
<div id="messageTitle-container">
<label for="messageTitle" id="messageTitle-header">
* Message Title:
</label></td><td>
<input type="text" placeholder="Your Message Title" name="messageTitle" id="messageTitle"/>
<?php  if (empty($_POST['messageTitle']))
 {
     echo "Message Title isn't filled in";
 }?>
</div></td></tr>
<tr><td>
  <tr><td>
<div id="message-container">
    <label id="message-header">
    *  Message:
    </label></td>
    <td>
    <textarea type="text" name="message" placeholder="Type your message here..." id="myMessage" colspan="2"/></textarea>
    <?php  if (empty($_POST['message']))
     {
         echo "Message isn't filled in";
     }?>
  </td>
</div></tr>
</table>
    <div id="divSubmit">
    <a><input type="submit" name="mySubmit" value="Submit" id="submit-Button"/><input type="reset" name="reset" value="Reset" id="reset-Button"/>
  </div></a>
    <input type="hidden" name="guestbookId" value="<?php echo $guestbook['guestbookId']?>"/>
  </form>
</div>
<div id="review-Form-PreviousMessages">
  Previous Messages:
</div>
<div id="main-container-PreviousMessages">
<form action="index.php" method="post">
  <?php
                      if (!empty($reviews)) {
                          // print table
                          echo "<table class=\"reviewTable\">";
                          foreach ($reviews as $guestbook) {
                              ?>
                              <tr>
                                  <td><i class="far fa-calendar" style="font-size:24px; color: #0282f9;"></i></td>
                                  <td><?php echo $guestbook['messageDate']; ?></td>
                                  <td><i class="far fa-clock" style="font-size:24px; color: #0282f9;"></i></td>
                              </tr>
                               <tr><td colspan="4">Firstname: <?php echo($guestbook['firstname']); ?></td></tr>
                               <tr><td colspan="4">Insertion: <?php echo($guestbook['insertion']); ?></td></tr>
                               <tr><td colspan="4">Lastname: <?php echo($guestbook['lastname']); ?></td></tr>
                               <tr><td colspan="4">E-mail: <?php echo($guestbook['email']); ?></td></tr>
                               <tr><td colspan="4">Website Address: <?php echo($guestbook['websiteAddress']); ?></td></tr>
                               <tr><td colspan="4">Message Title: <?php echo($guestbook['messageTitle']); ?></td></tr>
                               <tr><td colspan="4">Message: <?php echo($guestbook['message']); ?></td></tr>
                              <tr><td colspan="5"><hr /></td></tr>

                              <?php
                          }
                          echo "</table>";
                      } else {
                                ?>
                          <h5 class="reviewTable"><i class="fas fa-info-circle"></i>&nbsp;No comments yet..</h5>
                          <?php
                            }
                              ?>

</div>
</form>
</div>
  <?php include 'inc/footer.php'; ?>
  </body>
  </html>
