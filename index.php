<?php
include 'CRUD/conexion.php';

// Procesar cuando agregan un usuario
if (isset($_POST['enviar_usuario'])) {
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];

    $sql  = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nombre' => $nombre, 'email' => $email]);
    header("Location: index.php#crud");
    exit();
}

// Procesar eliminación de usuario
if (isset($_GET['eliminar'])) {
    $id   = $_GET['eliminar'];
    $sql  = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: index.php#crud");
    exit();
}

$stmt     = $pdo->query("SELECT * FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Umbrella Corporation - Secure Database</title>
        <link rel="icon" type="image/x-icon" href="Proyecto-GitHub/assets/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="Proyecto-GitHub/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top" class="bg-black text-white">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top border-bottom border-danger" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand text-danger fw-bold" href="#page-top"><i class="fas fa-biohazard me-2"></i>UMBRELLA NET</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#about">Protocol</a></li>
                        <li class="nav-item"><a class="nav-link" href="#projects">Facility</a></li>
                        <li class="nav-item"><a class="nav-link text-danger fw-bold" href="#crud">Database (CRUD)</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Header / Masthead -->
        <header class="masthead" style="background: linear-gradient(135deg, #0a0a0a, #4a0000);">
          <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
              <div class="text-center text-white">
                <div style="
                  display: inline-block;
                  background: rgba(180, 0, 0, 0.15);
                  border: 2px solid #dc3545;
                  padding: 15px 35px;
                  border-radius: 8px;
                  font-size: 2rem;
                  font-weight: bold;
                  letter-spacing: 5px;
                  color: #ff4d4d;
                  text-shadow: 0 0 15px rgba(220, 53, 69, 0.8);
                  margin-bottom: 25px;
                  box-shadow: inset 0 0 15px rgba(220, 53, 69, 0.3);
                ">
                  <i class="fas fa-biohazard me-2"></i>UMBRELLA CORP.
                </div>
                <h1 class="mx-auto my-0 text-uppercase text-danger" style="letter-spacing: 3px;">Hive System</h1>
                <h2 class="text-white-50 mx-auto mt-3 mb-4">Our Business is Life Itself. Secure Personnel Directory.</h2>
                <a class="btn btn-danger btn-lg fw-bold shadow text-uppercase px-4" href="#crud">Access Database</a>
              </div>
            </div>
          </div>
        </header>

        <!-- About Section -->
        <section class="about-section text-center bg-black" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-danger mb-4">Biohazard Protocol Active</h2>
                        <p class="text-white-50">
                            Authorized personnel only. All records are monitored and encrypted under Umbrella security guidelines.
                        </p>
                    </div>
                </div>
                <img class="img-fluid mt-4 border border-secondary rounded" src="Proyecto-GitHub/assets/img/umbrella.jpg" alt="Umbrella Protocol" />
            </div>
        </section>

        <!-- Projects Section -->
        <section class="projects-section bg-dark text-white" id="projects">
            <div class="container px-4 px-lg-5">
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0 border border-danger" src="Proyecto-GitHub/assets/img/corporation umbrella.jpg" alt="Corporation Umbrella" /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left p-4">
                            <h4 class="text-danger">Arklay Laboratory</h4>
                            <p class="text-white-50 mb-0">Subterranean biological research facility sector. Strict quarantine procedures in effect.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CRUD Section (Gestión de Usuarios) -->
        <section class="signup-section py-5 bg-black" id="crud">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-10 col-lg-8 mx-auto text-white">
                        <h2 class="text-center text-danger mb-4 text-uppercase tracking-wide"><i class="fas fa-terminal me-2"></i>Personnel Management</h2>
                        
                        <!-- Formulario para agregar -->
                        <div class="card bg-dark text-white p-4 shadow mb-5 border border-danger rounded-3">
                            <h4 class="mb-3 text-danger"><i class="fas fa-user-shield me-2"></i>Register New Subject</h4>
                            <form action="index.php" method="POST">
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-white-50">Subject Name</label>
                                    <input type="text" class="form-control bg-black text-white border-secondary" name="nombre" placeholder="Full Name" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-white-50">Secure Email</label>
                                    <input type="email" class="form-control bg-black text-white border-secondary" name="email" placeholder="agent@umbrella.com" required />
                                </div>
                                <button type="submit" name="enviar_usuario" class="btn btn-danger w-100 fw-bold text-uppercase tracking-wider">Authorize & Save</button>
                            </form>
                        </div>

                        <!-- Tabla de usuarios -->
                        <h4 class="mb-3 text-white-50"><i class="fas fa-database me-2"></i>Active Personnel Database</h4>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover table-bordered align-middle text-center border-secondary">
                                <thead class="table-danger text-black">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($usuarios)): ?>
                                        <tr><td colspan="4" class="text-muted">No personnel records found.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($usuarios as $usr): ?>
                                        <tr>
                                            <td><?php echo $usr['id']; ?></td>
                                            <td><?php echo htmlspecialchars($usr['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($usr['email']); ?></td>
                                            <td>
                                                <a href="CRUD/editar.php?id=<?php echo $usr['id']; ?>" class="btn btn-outline-warning btn-sm me-1"><i class="fas fa-edit"></i></a>
                                                <a href="index.php?eliminar=<?php echo $usr['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('WARNING: Terminate subject record?');"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer bg-black small text-center text-white-50 py-4 border-top border-secondary">
            <div class="container px-4 px-lg-5">&copy; UMBRELLA CORPORATION // SECURITY DIVISION 2026</div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="Proyecto-GitHub/js/scripts.js"></script>
    </body>
</html>