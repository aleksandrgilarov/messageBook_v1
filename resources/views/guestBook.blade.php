<!DOCTYPE html>
<html lang="en" ng-app="GuestBook">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="GuestBook">
    <meta name="author" content="Aleksandr Gilarov">

    <title>Гостевая книга</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   
	
	<!-- custom CSS for the page -->
    <link href="css/messages.css" rel="stylesheet">
    <link href="bower_components/dropzone/dist/basic.css" rel="stylesheet">
    <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src='https://www.google.com/recaptcha/api.js'></script>
      <script>
          var csrfToken = "{{csrf_token()}}";
      </script>
  </head>

  <body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#/">Гостевая книга</a>
        </div>
      </div>
    </nav>
	<!-- MAIN CONTENT AND INJECTED VIEWS -->
    <div id="main">
        <!-- this is where content will be injected -->
        <div ng-view></div>
    </div>

	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
	<script src="js/angular/angular.min.js"></script>
	<script src="js/angular/angular-route.min.js"></script>
	<script src="js/angular/angular-animate.js"></script>
	<script src="js/angular/angular-touch.js"></script>
	<script src="js/angular/angular-sanitize.js"></script>
	<script src="js/angular-recaptcha/release/angular-recaptcha.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/ui-bootstrap-tpls-2.5.0.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!-- AngularJS Application Scripts -->
	<script src="app/app.module.js"></script>
	<script src="app/messages/messages.controller.js"></script>
	<script src="bower_components/dropzone/dist/dropzone.js"></script>

  </body>
</html>
