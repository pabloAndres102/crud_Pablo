<?php
require_once('../Modelo/Producto.php');//Incluir el modelo Producto
require_once('../Modelo/crudProducto.php');//Incluir el CRUD.
class controladorProducto{
    //Crear el constructor
      
    public function __construct(){
    }

    public function listarProducto(){
       //Llamar el método listarProducto del crudProducto.
       $crudProducto = new crudProducto();//Instanciar crudProducto
       $listaProducto = $crudProducto->listarProducto();//Listado de productos
       return $listaProducto;
    }

    ////Recibe los valores del formulario, crea un objeto y envía la petición al CRUD
    public function registrarProducto($e_idCategoria,$e_nombre,$e_precio,$e_estado){
      //Instanciación del objeto Producto
      $Producto = new Producto();//Crear un objeto del tipo Producto
      $Producto->setidProducto('');//Asignar el valor del formulario al objeto
      $Producto->setidCategoria($e_idCategoria);
      $Producto->setnombre($e_nombre);//Asignar el valor del formulario
      $Producto->setprecio($e_precio);
      $Producto->setestado($e_estado);

      //Solicitar al crudProducto realice la inserción
      $crudProducto = new crudProducto();
      $mensaje = $crudProducto->registrarProducto($Producto);
      //Imprimir el mensaje del resultado de la inserción con jscript
      echo "
      <script>
         alert('$mensaje');
         document.location.href = '../Vista/listarProducto.php';
      </script>
      ";
   }

   public function buscarProducto($e_idProducto){
      $Producto = new Producto(); //Definir un objeto de la clase Producto
      $Producto->setidProducto($e_idProducto);//Setear valores

      $crudProducto = new crudProducto(); //Definir un objeto de la clase crudProducto
      //var_dump($Producto);
      $datosProducto = $crudProducto->buscarProducto($Producto); //LLamar el método del crud
      //var_dump($datosProducto);
      $Producto->setnombre($datosProducto['nombre']);
      return $Producto;
   }

   public function actualizarProducto($e_idProducto,$e_nombre){
      //Instanciación del objeto Producto
      $Producto = new Producto();//Crear un objeto del tipo Producto
      $Producto->setidProducto($e_idProducto);//Asignar el valor del formulario al objeto
      $Producto->setnombre($e_nombre);//Asignar el valor del formulario
    
      //Solicitar al crudProducto realice la actualización
      $crudProducto = new crudProducto();
      $crudProducto->actualizarProducto($Producto); 
   }

   public function eliminarProducto($e_idProducto){
      //Instanciación del objeto Producto
      $Producto = new Producto();//Crear un objeto del tipo Producto
      $Producto->setidProducto($e_idProducto);//Asignar el valor del formulario al objeto
      $Producto->setnombre('');//Asignar el valor del formulario
    
      //Solicitar al crudProducto realice la eliminación
      $crudProducto = new crudProducto();
      $crudProducto->eliminarProducto($Producto); 
   }

   public function desplegarVista($pagina){
      //Redireccionar hacia la una vista
      header("Location:../Vista/".$pagina);
   }

}

//Probar el Controlador
$controladorProducto = new controladorProducto();
$listaProducto = $controladorProducto->listarProducto();//Verificar si se devuelven datos

//Verificar la acción a realizar.
if(isset($_POST['Registrar'])){//isset: Establer si una variable existe
   //echo "Registrando";
   //Capturar los datos enviados desde el formulario
   $e_idCategoria = $_POST['idCategoria'];
   $e_nombre = $_POST['nombre']; //Captura del nombre digitado en la caja de texto
   $e_precio = $_POST['precio'];
   $e_estado = $_POST['estado'];

   //Hacer la petición al controlador
   $controladorProducto->registrarProducto($e_idCategoria,$e_nombre,$e_precio,$e_estado);
}
else if(isset($_POST['Editar'])){
   $e_idProducto = $_POST['idProducto']; //Recibir variable del formulario
   //echo $e_idProducto;
   $controladorProducto->desplegarVista("editarProducto.php?idProducto=$e_idProducto");
}
else if(isset($_REQUEST['Actualizar'])){
   //Capturar valores enviados desde la vista
   $e_idProducto = $_REQUEST['idProducto'];
   $e_nombre = $_REQUEST['nombre'];

   //Llamar el método actualizarProducto()
   $controladorProducto->actualizarProducto($e_idProducto,$e_nombre); 
}
else if(isset($_REQUEST['Eliminar'])){
   //Capturar valores enviados desde la vista
   $e_idProducto = $_REQUEST['idProducto'];

   //Llamar el método eliminarProducto()
   $controladorProducto->eliminarProducto($e_idProducto); 
}
else if(isset($_REQUEST['vista'])){
   $controladorProducto->desplegarVista($_REQUEST['vista']);
}
//Probar en el navegador

//Probar la creación de objetos
//crear o instanciar 1 objeto de la clase Producto.


/*
$Producto1 = new Producto();

var_dump($Producto1);
$Producto1->setidProducto($_POST['id']);
$Producto1->setnombre($_POST['nombre']);
//var_dump($Producto1);
echo "<br>";
echo "El id de la Producto es: ".$Producto1->getidProducto();
echo "<br>";
echo "El nombre de la Producto es: ".$Producto1->getnombre();

*/
?>