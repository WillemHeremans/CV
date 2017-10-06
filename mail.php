<!DOCTYPE html>
<html lang="fr">
<html>

<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" href="./assets/css/mail.css"/>
  <style>
.error {color: rgb(219, 54, 174);}
</style>
</head>


<body bgcolor="#E6E6FA">

  <?php include 'back-submit-mail.php';?>

  <?php
// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $websiteErr = "";
$fname = $lname = $email = $subject = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "Firts name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
    }
  }

    if (empty($_POST["lname"])) {
      $lnameErr = "Last name is required";
    } else {
      $lname = test_input($_POST["lname"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
        $lnameErr = "Only letters and white space allowed";
      }
    }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["subject"])) {
    $subject = "";
  } else {
    $subject = test_input($_POST["subject"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1 class="first">&nbsp;</h1>

  <div class="container">
 <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

   <span class="error">* </span>
   <label for="fname">Prénom</label>
   <input type="text" id="fname" name="fname" placeholder="Votre prénom...">
   <span class="error">*</span>

   <label for="lname">Nom</label>
   <input type="text" id="lname" name="lname" placeholder="Votre nom...">
   <span class="error">*</span>

   <label for="mail">Email</label>
   <input type="text" id="mail" name="email" placeholder="Votre email...">


   <label for="country">Country</label>
   <select id="country" name="country">
     <option value="australia">Belgium</option>
     <option value="usa">USA</option>
     <option value="canada">Canada</option>
   </select>

   <label for="subject">Sujet</label>
   <textarea id="subject" name="subject" placeholder="Ecrivez quelque chose..." style="height:200px"></textarea>

 </form>


<?php
//echo $fname;
//echo "<br>";
//echo $lname;
//echo "<br>";
// echo $email;
// echo "<br>";
// echo $subject;
// echo "<br>";
?>

</div>

<h1 class="first">&nbsp;</h1>

</body>

</html>
