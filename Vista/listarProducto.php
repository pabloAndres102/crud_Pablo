<?php
require_once('../Controlador/controladorProducto.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de  Productos Yesenia</title>
</head>
<body>
    <a href="../Controlador/controladorProducto.php?vista=registrarProducto.php" >Registrar</a>
    <h1 align="center">Productos</h1>
    <table border="1" align="center">
        <thead>
            <tr>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listaProducto as $producto){
                    echo "<tr>";
                    echo "<td>".$producto['idProducto']."</td>";
                    echo "<td>".$producto['nombre']."</td>";
                    echo "<td>$".number_format($producto['precio'],2,",",".")."</td>";
                    echo "<td>
                    <form id='frmProducto$producto[idProducto]' method='POST' action='../Controlador/controladorProducto.php'>
                        <input type='hidden' name='idProducto' value=".$producto['idProducto']." />
                        <button type='submit' name='Editar'>Editar</button>
                        <button type='button' onclick='validarEliminacion($producto[idProducto])' name='Eliminar'>Eliminar</button>
                        <input type='hidden' name='Eliminar' />
                        </form>
                    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <script>
        //Declarar la función de javascript
        function validarEliminacion(idProducto){
            if(confirm('¿Realmente desea eliminar?')){
                document.getElementById('frmProducto'+idProducto).submit();
            }
        }
    </script>
</body>
</html>