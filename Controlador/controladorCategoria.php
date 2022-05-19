<?php
require_once('../Modelo/Categoria.php');//Incluir el modelo Categoria
require_once('../Modelo/crudCategoria.php');//Incluir el CRUD.
class controladorCategoria{
    //Crear el constructor
      
    public function __construct(){
       //$categoria = new Categoria(); //Instanciar un objeto categoria
       //$crudCategoria = new crudCategoria();//Instanciar crudCategoria
    }

    public function listarCategoria(){
       //Llamar el método listarCategoria del crudCategoria.
       $crudCategoria = new crudCategoria();//Instanciar crudCategoria
       $listaCategoria = $crudCategoria->listarCategoria();//Listado de categorias
       return $listaCategoria;
    }

    ////Recibe los valores del formulario, crea un objeto y envía la petición al CRUD
    public function registrarCategoria($e_nombre){
      //Instanciación del objeto categoria
      $categoria = new Categoria();//Crear un objeto del tipo categoria
      $categoria->setidCategoria('');//Asignar el valor del formulario al objeto
      $categoria->setnombre($e_nombre);//Asignar el valor del formulario
    
      //Solicitar al crudCategoria realice la inserción
      $crudCategoria = new crudCategoria();
      $mensaje = $crudCategoria->registrarCategoria($categoria);
      //Imprimir el mensaje del resultado de la inserción con jscript
      echo "
      <script>
         alert('$mensaje');
         document.location.href = '../Vista/listarCategoria.php';
      </script>
      ";
   }

   public function buscarCategoria($e_idCategoria){
      $categoria = new Categoria(); //Definir un objeto de la clase Categoria
      $categoria->setidCategoria($e_idCategoria);//Setear valores

      $crudCategoria = new crudCategoria(); //Definir un objeto de la clase crudCategoria
      //var_dump($categoria);
      $datosCategoria = $crudCategoria->buscarCategoria($categoria); //LLamar el método del crud
      //var_dump($datosCategoria);
      $categoria->setnombre($datosCategoria['nombre']);
      return $categoria;
   }

   public function actualizarCategoria($e_idCategoria,$e_nombre){
      //Instanciación del objeto categoria
      $categoria = new Categoria();//Crear un objeto del tipo categoria
      $categoria->setidCategoria($e_idCategoria);//Asignar el valor del formulario al objeto
      $categoria->setnombre($e_nombre);//Asignar el valor del formulario
    
      //Solicitar al crudCategoria realice la actualización
      $crudCategoria = new crudCategoria();
      $crudCategoria->actualizarCategoria($categoria); 
   }

   public function eliminarCategoria($e_idCategoria){
      //Instanciación del objeto categoria
      $categoria = new Categoria();//Crear un objeto del tipo categoria
      $categoria->setidCategoria($e_idCategoria);//Asignar el valor del formulario al objeto
      $categoria->setnombre('');//Asignar el valor del formulario
    
      //Solicitar al crudCategoria realice la eliminación
      $crudCategoria = new crudCategoria();
      $crudCategoria->eliminarCategoria($categoria); 
   }

   public function desplegarVista($pagina){
      //Redireccionar hacia la una vista
      header("Location:../Vista/".$pagina);
   }

}

//Probar el Controlador
$controladorCategoria = new controladorCategoria();
$listaCategoria = $controladorCategoria->listarCategoria();//Verificar si se devuelven datos

//Verificar la acción a realizar.
if(isset($_POST['Registrar'])){//isset: Establer si una variable existe
   //echo "Registrando";
   //Capturar los datos enviados desde el formulario
   $e_nombre = $_POST['nombre']; //Captura del nombre digitado en la caja de texto

   //Hacer la petición al controlador
   $controladorCategoria->registrarCategoria($e_nombre);
}
else if(isset($_POST['Editar'])){
   $e_idCategoria = $_POST['idCategoria']; //Recibir variable del formulario
   //echo $e_idCategoria;
   $controladorCategoria->desplegarVista("editarCategoria.php?idCategoria=$e_idCategoria");
}
else if(isset($_REQUEST['Actualizar'])){
   //Capturar valores enviados desde la vista
   $e_idCategoria = $_REQUEST['idCategoria'];
   $e_nombre = $_REQUEST['nombre'];

   //Llamar el método actualizarCategoria()
   $controladorCategoria->actualizarCategoria($e_idCategoria,$e_nombre); 
}
else if(isset($_REQUEST['Eliminar'])){
   //Capturar valores enviados desde la vista
   $e_idCategoria = $_REQUEST['idCategoria'];

   //Llamar el método eliminarCategoria()
   $controladorCategoria->eliminarCategoria($e_idCategoria); 
}
else if(isset($_REQUEST['vista'])){
   $controladorCategoria->desplegarVista($_REQUEST['vista']);
}
//Probar en el navegador

//Probar la creación de objetos
//crear o instanciar 1 objeto de la clase Categoria.


/*
$categoria1 = new Categoria();

var_dump($categoria1);
$categoria1->setidCategoria($_POST['id']);
$categoria1->setnombre($_POST['nombre']);
//var_dump($categoria1);
echo "<br>";
echo "El id de la categoria es: ".$categoria1->getidCategoria();
echo "<br>";
echo "El nombre de la categoria es: ".$categoria1->getnombre();

*/
?>