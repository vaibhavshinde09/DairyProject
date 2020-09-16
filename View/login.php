<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dairy Farm</title>  
    <link href="favicon.png" rel="shortcut icon"/>
          
   
	<style>
                    html,
                    body {
                    height: 100%;
                    }

                    body {
                    display: -ms-flexbox;
                    display: -webkit-box;
                    display: flex;
                    -ms-flex-align: center;
                    -ms-flex-pack: center;
                    -webkit-box-align: center;
                    align-items: center;
                    -webkit-box-pack: center;
                    justify-content: center;
                    padding-top: 40px;
                    padding-bottom: 40px;
                    background-color: #f5f5f5;
                    }

                    .form-signin {
                    width: 100%;
                    max-width: 330px;
                    padding: 15px;
                    margin: 0 auto;
                    }
                    .form-signin .checkbox {
                    font-weight: 400;
                    }
                    .form-signin .form-control {
                    position: relative;
                    box-sizing: border-box;
                    height: auto;
                    padding: 10px;
                    font-size: 16px;
                    }
                    .form-signin .form-control:focus {
                    z-index: 2;
                    }
                    .form-signin input[type="email"] {
                    margin-bottom: -1px;
                    border-bottom-right-radius: 0;
                    border-bottom-left-radius: 0;
                    }
                    .form-signin input[type="password"] {
                    margin-bottom: 10px;
                    border-top-left-radius: 0;
                    border-top-right-radius: 0;
                    }

	</style>
  </head>
  <body class="text-center">
    <form class="form-signin" method="POST" action="action.php">
	
      <img class="mb-4" src="favicon.png" alt="The Creator" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">User Name</label>
      <input type="text" id="username" name="username" class="form-control" autocomplete="off" placeholder="Enter your UserName" required
	  value=<?php if(isset($_COOKIE[ "username"])){echo $_COOKIE[ "username"];} ?>>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" autocomplete="off" class="form-control" placeholder="Password" required  value=<?php if(isset($_COOKIE[ "password"])){echo $_COOKIE[ "password"];} ?>>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" name="remember"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" name="login" id="login" type="submit">Sign in</button>
	  <br/>
	  
 <div class="alert alert-warning alert-dismissible fade show" id="myerr" role="alert"style="display: none;">
  <strong>Incorrect </strong> UserName and Password Please Try Again ?.
   
</div>
      <p class="mt-5 mb-3 text-muted">© 2019-2020</p>
    </form>
	<script>
	 var url_string = window.location.href;
                var url = new URL(url_string);
                var c = url.searchParams.get("err");
                if (c) {
                    var res = "block";
                }
                var tag = document.getElementById("myerr").style.display = res;
				
	</script>
	  </body>
</html>
