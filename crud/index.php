<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Proyecto CRUD</title>
        <script type="text/JavaScript">
            function borra_cliente(id) {
            var answer = confirm('¿Estás seguro que deseas borrar el cliente?');
            if (answer) {
            // si el usuario hace click en ok,
            // se ejecutar borrar.php
            window.location = 'borra.php?id=' + id;
            }
            }
        </script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
