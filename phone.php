<!DOCTYPE html>

<html lang="fr">
<html>

<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" href="./assets/css/phone.css"/>
  <link rel="stylesheet" href="./assets/css/index.css"/>

  <script src="https://simplewebrtc.com/latest-v2.js"></script>

</head>

<body bgcolor="#E6E6FA">

  <?php include 'back-submit-mail.php';?>

  <video height="300" id="localVideo"></video>
          <div id="remotesVideos"></div>

          <script type="text/javascript">
          var webrtc = new SimpleWebRTC({
  // the id/element dom element that will hold "our" video
  localVideoEl: 'localVideo',
  // the id/element dom element that will hold remote videos
  remoteVideosEl: 'remotesVideos',
  // immediately ask for camera access
  autoRequestMedia: true
});

// we have to wait until it's ready
webrtc.on('readyToCall', function () {
  // you can name it anything
  webrtc.joinRoom('your awesome room name');
});

          </script>
</body>
</html>
