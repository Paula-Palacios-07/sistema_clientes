<?php include('partials/header.php'); ?>
<?php include('partials/navbar.php'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <h2>Bienvenido al Sistema de Gestión de Clientes</h2>
                <p>Este sistema permite a los usuarios ingresar y gestionar datos de clientes, incluyendo la selección de una ubicación geográfica utilizando una interfaz gráfica de Google Maps. Los datos de los clientes se organizan automáticamente por distancia desde un punto específico, permitiendo una gestión eficiente y precisa de las ubicaciones.</p>
                <p>Funcionalidades clave:</p>
                <ul>
                    <li>Ingresar datos de clientes con una interfaz gráfica.</li>
                    <li>Seleccionar la ubicación de destino en un mapa interactivo.</li>
                    <li>Consultar y organizar clientes por distancia a un punto determinado.</li>
                </ul>
                <div class="mt-4">
                    <a href="index.php?action=create" class="btn btn-primary mr-2">Crear Cliente</a>
                    <a href="index.php?action=list" class="btn btn-secondary">Consultar Clientes</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <img src="./assets/images/ubicacion.png" class="img-fluid" alt="Descripción de la imagen">
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>
