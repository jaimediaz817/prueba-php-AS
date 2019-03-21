<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $this->title; ?></title>

        <!-- <base href="views/"> -->

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>

    <body>
        view content
        <?php
            //echo SINGLE_URL;
        ?>
        <p>
            {# <strong>Hola <?php echo $this->test; ?></strong> #}
        </p>

        <?php if(empty($this->arrJoin)) :?>
            <div>Array vacio</div>
        <?php else: ?>
            <?php foreach($this->arrJoin as $val) :?>
                <div><?= $val->usua_nombres ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

                        
        <h4>Perfiles disponibles</h4>
        <select class="select">
            <?php while($usuario = $this->res->fetch_object()): ?>
                <option value="<?php echo $usuario->perf_id_pk; ?>"><?php echo $usuario->perf_nombres; ?></option>            
            <?php endwhile; ?>
        </select>


        <?php echo SINGLE_URL ?> <- ES LA PATH
        <?php echo SINGLE_URL_OLD ?> <- ES LA PATH
        <?php echo ENVIROMENT_NAME ?> <- ENVIROMENT
        

        <!-- Scripts -->
        <script src="<?php echo ASSET_URL ?>js/libraries/jquery-plugins/jquery-3.2.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>        

        <!-- CUSTOM -->
        <input id="urlSelector" type="hidden" name="url" value="<?php echo SINGLE_URL; ?>">
        <script src="<?php echo ASSET_URL ?>js/Index/indexController.js">
            var URL_SINGLE = <?php echo SINGLE_URL ?>;
        </script>
    </body>
</html>