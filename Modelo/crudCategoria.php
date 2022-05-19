<?php
//CRUD =C:CREAR,INSERT, R:READ:LEER:SELECT,U:UPDATE:MODIFICAR D:DELETE:ELIMINAR O BORRAR
require_once('conexion.php');//8959-15C9Incluir el archivo conexión
class crudCategoria{
    public function __construct(){
    }

    //Método para consultar todas las categorías
    //de la base de datos.
    public function listarCategoria(){//Read del CRUD:SELECT
      //Establecer la conexión a la base datos
      $baseDatos = Conexion::conectar();
      //Definir la sentencia sql
      $sql = $baseDatos->query('SELECT * FROM categoria ORDER BY nombre ASC');
      //Ejecutar la consulta
      $sql->execute();
      //Cerrar la conexión
      Conexion::desconectar($baseDatos);
      //Retornar el resultado de la consulta a la tabla.
      return($sql->fetchAll());//Retornar el resultado de la consulta
    }

    public function registrarCategoria($categoria){ //Recibe un objeto de la clase categoria
      $mensaje = ""; //Declarar una variable llamada mensaje
      //Establecer la conexión a la base datos
      $baseDatos = Conexion::conectar();  
      //Preparar la sentencia sql
      //e_ indica que es un dato de entrada
      $sql = $baseDatos->prepare('INSERT INTO 
      categoria(idCategoria,nombre)
      VALUES(:e_idCategoria, :e_nombre) ');
      //Las siguientes líneas capturan los valores de los atributos del objeto
      $sql->bindValue('e_idCategoria', $categoria->getidCategoria());
      $sql->bindValue('e_nombre', $categoria->getnombre());
      try{ //Capturar excepciones de la base de datos
        //Ejecutar la consulta
        $sql->execute();
        $mensaje = "Registro exitoso";
      }
      catch(Exception $excepcion){ //Exception: Excepción o un error
        //echo $excepcion->getMessage();
        $mensaje = "Problemas en el registro";
      }
      //Cerrar la conexión
      Conexion::desconectar($baseDatos);
      return $mensaje;
    }

    public function buscarCategoria($categoria){//Read del CRUD:SELECT
      //Establecer la conexión a la base datos
      //var_dump($categoria);
      $baseDatos = Conexion::conectar();
      //Definir la sentencia sql
      $sql = $baseDatos->query("SELECT * FROM categoria WHERE idCategoria=".$categoria->getidCategoria());
      //Ejecutar la consulta
      $sql->execute();
      //Cerrar la conexión
      Conexion::desconectar($baseDatos);
      //Retornar el resultado de la consulta a la tabla.
      return($sql->fetch());//Retornar el resultado de la consulta
    }

    public function actualizarCategoria($categoria){ //Recibe un objeto de la clase categoria
      //Establecer la conexión a la base datos
      $baseDatos = Conexion::conectar();  
      //Preparar la sentencia sql
      //e_ indica que es un dato de entrada
      $sql = $baseDatos->prepare('UPDATE  
      categoria SET nombre =:e_nombre WHERE idCategoria=:e_idCategoria');
      //Las siguientes líneas capturan los valores de los atributos del objeto
      $sql->bindValue('e_idCategoria', $categoria->getidCategoria());
      $sql->bindValue('e_nombre', $categoria->getnombre());
      try{ //Capturar excepciones de la base de datos
        //Ejecutar la consulta
        $sql->execute();
        echo "Actualización exitosa";
      }
      catch(Exception $excepcion){ //Exception: Excepción o un error
        echo $excepcion->getMessage();
        echo "Problemas en la actualización";
      }
      //Cerrar la conexión
      Conexion::desconectar($baseDatos);
    }

    public function eliminarCategoria($categoria){ //Recibe un objeto de la clase categoria
      //Establecer la conexión a la base datos
      $baseDatos = Conexion::conectar();  
      //Preparar la sentencia sql
      //e_ indica que es un dato de entrada
      $sql = $baseDatos->prepare('DELETE FROM  
      categoria WHERE idCategoria=:e_idCategoria');
      //Las siguientes líneas capturan los valores de los atributos del objeto
      $sql->bindValue('e_idCategoria', $categoria->getidCategoria());
      try{ //Capturar excepciones de la base de datos
        //Ejecutar la consulta
        $sql->execute();
        echo "Eliminación exitosa";
      }
      catch(Exception $excepcion){ //Exception: Excepción o un error
        //echo $excepcion->getMessage();
        echo "Problemas en la eliminación";
      }
      //Cerrar la conexión
      Conexion::desconectar($baseDatos);
    }
}



?>