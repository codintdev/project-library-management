<?php require '../include/header.php'; ?>

<div class="container text-center">

    <div class="row align-items-start p-3">
        <div class="col-md-auto">
            <h1 class="display-1">Gestor de biblioteca</h1>
            <span>Bookint es tu gestor de biblioteca favorito, te podemos ofrecer el mejor sistema para gestionar tus usuarios, empleados, libros, prestamos y reservas</span>
        </div>
    </div>

    <div id="carouselExample" class="carousel slide p-3">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/public/images/library-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/public/images/library-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/public/images/library-3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        
    </div>

</div>

<?php require '../include/footer.php'; ?>
