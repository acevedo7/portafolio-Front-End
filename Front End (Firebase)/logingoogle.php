<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="admin.css">
  <script src="https://use.fontawesome.com/fefc2fb08e.js"></script>
  <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Iniciar sesión</title>
</head>
<body>
     <div class="opcionlogin">
  <h1>Iniciar sesión con:</h1>
  <button onclick="iniciarSesion()" type="button" class="btn btn-danger">Iniciar con <i class="fa fa-google"></i></button>
  <button type="button" class="btn btn-primary">Primary</button>
     </div>

  <script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-firestore.js"></script>
  <script>
  
    var firebaseConfig = {
  apiKey: "AIzaSyAhFfUx9t5N2_mJ4XSjrbv_27A4PgrLNIU",
  authDomain: "portafolio-5e28f.firebaseapp.com",
  projectId: "portafolio-5e28f",
  storageBucket: "portafolio-5e28f.appspot.com",
  messagingSenderId: "596683497898",
  appId: "1:596683497898:web:4bf8b545fddd9f121b4bd3",
  measurementId: "G-0ZDXHLL2WV"
    };
     
    firebase.initializeApp(firebaseConfig);

    function iniciarSesion() {
      var provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().signInWithPopup(provider)
      .then((result) => {
        var user = result.user;
        console.log(user);
        window.location.href = "comprobar_usuario.php?username=" + user.displayName;
      })

      .catch((error) => {
        console.log(error);
      });
    }
  </script>
  <script>
    var username = user.displayName;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var response = JSON.parse(this.responseText);
    if (response.exists) {
      window.location.href = "portafolio.php";
    } else {
      console.log("El usuario no esta .");
    }
  }
};
xhttp.open("GET", "comprobar_usuario.php?username=" + username, true);
xhttp.send();

  </script>

</body>
</html>
