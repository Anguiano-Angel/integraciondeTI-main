<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nombre' => $nombre, 'email' => $email, 'id' => $id]);

    header("Location: ../index.php#crud");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Edit Record - Umbrella Secure Terminal</title>
        <link rel="icon" type="image/x-icon" href="../Proyecto-GitHub/assets/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="../Proyecto-GitHub/css/styles.css" rel="stylesheet" />
    </head>
    <body class="bg-black text-white" id="page-top">
        
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <div class="card bg-dark text-white p-4 shadow-lg border border-danger rounded-3">
                    <div class="text-center mb-4">
                        <div style="
                          display: inline-block;
                          background: rgba(180, 0, 0, 0.15);
                          border: 2px solid #dc3545;
                          padding: 10px 25px;
                          border-radius: 8px;
                          font-size: 1.4rem;
                          font-weight: bold;
                          letter-spacing: 3px;
                          color: #ff4d4d;
                          margin-bottom: 15px;
                        ">
                          <i class="fas fa-biohazard me-2"></i>UMBRELLA CORP.
                        </div>
                        <h2 class="text-danger">Modify Subject Record</h2>
                        <p class="text-white-50">Secure Terminal // Update authorization parameters.</p>
                    </div>

                    <form action="editar.php?id=<?php echo $id; ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-white-50">Subject Name</label>
                            <input type="text" class="form-control bg-black text-white border-secondary" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-white-50">Secure Email</label>
                            <input type="email" class="form-control bg-black text-white border-secondary" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required />
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="../index.php#crud" class="btn btn-outline-light px-4">Abort</a>
                            <button type="submit" name="actualizar" class="btn btn-danger fw-bold px-4">Save Updates</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../Proyecto-GitHub/js/scripts.js"></script>
    </body>
</html>