<?php
include 'api.php';

// Procesar formulario de agregar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $data = [
        "name" => $_POST['name'],
        "price" => $_POST['price'],
        "quantity" => $_POST['quantity']
    ];
    addProduct($data);
    header("Location: index.php");
    exit();
}

// Procesar eliminación de producto
if (isset($_GET['delete_id'])) {
    deleteProduct($_GET['delete_id']);
    header("Location: index.php");
    exit();
}

// Obtener listado de productos
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Gestión de Productos</h1>

    <!-- Formulario para agregar productos -->
    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Nombre del producto" required>
            </div>
            <div class="col">
                <input type="number" name="price" class="form-control" placeholder="Precio" step="0.01" required>
            </div>
            <div class="col">
                <input type="number" name="quantity" class="form-control" placeholder="Cantidad" required>
            </div>
            <div class="col">
                <button type="submit" name="add_product" class="btn btn-success">Agregar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de productos -->
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Fecha de Carga</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?></td>
                    <td><?= htmlspecialchars($product['quantity']) ?></td>
                    <td><?= htmlspecialchars($product['createdAt']) ?></td>
                    <td>
                        <a href="?delete_id=<?= $product['id'] ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('¿Estás seguro de eliminar este producto?');">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
