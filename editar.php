<?php 

include("db.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tarea WHERE id = $id";
    $resultado = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($resultado) == 1 ) {
        $fila = mysqli_fetch_array($resultado);
        $titulo = $fila['titulo'];
        $descripcion = $fila['descripcion'];
    }
}

// Valido si viene por POST
if(isset($_POST['actualizar'])) {
    $id = $_GET['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $query = "UPDATE tarea set titulo = '$titulo', descripcion = '$descripcion' WHERE id = $id";
    mysqli_query($conn, $query);

    $_SESSION['mensaje'] = 'Tarea actualizada satisfactoriamente';
    $_SESSION['mensaje_tipo'] = "warning";

    header("location: index.php");
}

?>

<?php include("includes/header.php") ?>

<div class="container p-4" >
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar.php?id=<?= $_GET['id'] ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name= "titulo" value="<?php echo $titulo; ?>" class="form-control" placeholder="Actualizar titulo">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" id="" cols="" rows="2" class="form-control" placeholder="Actualizar descripcion"><?= $descripcion ?></textarea>
                    </div>
                    <button class="btn btn-success" name="actualizar">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>