<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Title -->
        <title><?php echo $this->title; ?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

        <link rel="stylesheet" href="<?php echo ASSET_URL ?>styles/styles.css">
    </head>
    <body>
        
        <main>
            <header>            
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Access to app</a>
                </nav>                
            </header>

            <section class="login-container d-flex align-items-center justify-content-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <form class="form-container" id="form-login">
                                <div class="form-group">
                                    <label for="loginInput">Login:</label>
                                    <input type="text" name="login" id="loginInput" class="form-control" enabled autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="passwordInput">Password:</label>
                                    <input type="password" name="password" id="passwordInput" class="form-control">
                                </div>

                                <div class="form-group group-email-validation d-none">
                                    <label for="passwordInput">Email:</label>
                                    <input type="email" name="email" id="emailInput" class="form-control">
                                    <a class="btn btn-primary" id="sendMailFinal" href="javascript:;" role="button">Send link to this email</a>
                                </div>

                                <div class="form-group">
                                    <button type="submit" id="signIn" class="btn btn-primary">Sign In</button>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">You must validate through an email access to the platform as a security mechanism, thank you.</small>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- CUSTOM -->
        <input id="urlSelector" type="hidden" name="url" value="<?php echo SINGLE_URL; ?>">

        <!-- Scripts -->
        <script src="<?php echo ASSET_URL ?>js/libraries/jquery-plugins/jquery-3.2.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>        

        <script src="<?php echo ASSET_URL ?>js/Login/loginController.js">
            var URL_SINGLE = <?php echo SINGLE_URL ?>;
        </script>    
    </body>
</html>