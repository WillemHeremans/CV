<?php
session_start ();
function loginForm() {
	echo '
    <div id="loginform">
    <form action="chat.php" method="post">
        <p>Please enter your name to continue:</p>

        <input type="text" name="name" id="name" />

				<footer>

				  <form name="message" action="">
				    <a href="#chat"><input class="tablink-alone" type="submit" name="enter" id="enter" value="Submit" /></a>

				  </form>
				</footer>
    </form>
    </div>
    ';
}

if (isset ( $_POST ['enter'] )) {
	if ($_POST ['name'] != "") {
		$_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
		$fp = fopen ( "log.html", 'a' );
		fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>" );
		fclose ( $fp );
	} else {
		echo '';
	}
}

if (isset ( $_GET ['logout'] )) {

	// Simple exit message
	$fp = fopen ( "log.html", 'a' );
	fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>" );
	fclose ( $fp );

	session_destroy ();
	header ( "Location: chat.php" ); // Redirect the user
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./assets/css/chat.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Chat avec Willem Heremans</title>
</head>
<body bgcolor="#E6E6FA">


  <?php include 'back-submit-chat.php';?>

  <h1 class="top">&nbsp;</h1>

	<?php
	if (! isset ( $_SESSION ['name'] )) {
		loginForm ();
	} else {
		?>


<div id="wrapper">
		<div id="menu">
			<p class="welcome">
				Welcome, <b class="name"><?php echo $_SESSION['name']; ?></b>
			</p>
			<p class="logout">
                <a id="exit" href="#">&#10006;</a>
            </p>
			<div style="clear: both"></div>
		</div>

		<div id="chatbox"><?php
		if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
			$handle = fopen ( "log.html", "r" );
			$contents = fread ( $handle, filesize ( "log.html" ) );
			fclose ( $handle );

			echo $contents;
		}
		?></div>

		<form name="message" action="">
			<input name="usermsg" type="text" id="usermsg" size="63" />
			<!-- Footer menu -->
			<footer>
			  <form name="message" action="">
			    <input class="tablink-alone" name="submitmsg" type="submit" id="submitmsg" value="Submit" />
			  </form>
			</footer>
			<!-- Footer menu -->
		</form>
		</div>

	<script type="text/javascript"
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
		</script>

	<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});

//jQuery Document
$(document).ready(function(){
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Are you sure you want to end the session?");
		if(exit==true){window.location = 'chat.php?logout=true';}
	});
});

//If user submits the form
$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});
		$("#usermsg").attr("value", "");
		loadLog;
	return false;
});

function loadLog(){
	var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
	$.ajax({
		url: "log.html",
		cache: false,
		success: function(html){
			$("#chatbox").html(html); //Insert chat log into the #chatbox div

			//Auto-scroll
			var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
			if(newscrollHeight > oldscrollHeight){
				$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
			}
	  	},
	});
}

setInterval (loadLog, 100);
</script>
<?php
	}
	?>
	<script type="text/javascript"
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<script type="text/javascript">
</script>
</body>
</html>
