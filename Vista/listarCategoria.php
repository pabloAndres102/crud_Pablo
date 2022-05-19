<?php
require_once('../Controlador/controladorCategoria.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Categorias</title>
</head>
<body>
    <a href="../Controlador/controladorCategoria.php?vista=registrarCategoria.html" >Registrar</a>
    <h1 align="center">Categorías</h1>
    <table border="1" align="center">
        <thead>
            <tr>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listaCategoria as $categoria){
                    echo "<tr>";
                    echo "<td>".$categoria['idCategoria']."</td>";
                    echo "<td>".$categoria['nombre']."</td>";
                    echo "<td>
                    <form id='frmCategoria$categoria[idCategoria]' method='POST' action='../Controlador/controladorCategoria.php'>
                        <input type='hidden' name='idCategoria' value=".$categoria['idCategoria']." />
                        <button type='submit' name='Editar'>Editar</button>
                        <button type='button' onclick='validarEliminacion($categoria[idCategoria])' name='Eliminar'>Eliminar</button>
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
        function validarEliminacion(idCategoria){
            if(confirm('¿Realmente desea eliminar?')){
                //document.frmCategoria.submit();
                document.getElementById('frmCategoria'+idCategoria).submit();
            }
        }
    </script>
</body>
</html>