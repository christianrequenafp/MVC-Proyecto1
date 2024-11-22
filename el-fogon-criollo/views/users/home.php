<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | El Fogon Criollo</title>
</head>
<body>
    <!-- Seccion 1 -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="./assets/images/carrusel-1.webp" class="d-block w-100 carousel-image" alt="Imagen 1 del carrusel">
                <div class="carousel-caption d-none d-md-block custom-caption">
                    <h1 class="display-4 fw-bold text-white">PROCESO DE ELABORACIÓN <br> DE LA CARNE</h1>
                      <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-6"><p class="text-warning">Ver todo</p></div>
                            <div class="col-6 text-end"><a href="#" class="btn btn-warning rounded-pill px-4 py-2 text-end">CONOCER HISTORIA</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="./assets/images/carrusel-2.webp" class="d-block w-100" alt="Imagen 2 del carrusel">
                <div class="carousel-caption d-none d-md-block custom-caption">
                    <h1 class="display-4 fw-bold text-white">HISTÓRIA DE LA PARRILLA <br> EN ARGENTINA</h1>
                    <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-6"><p class="text-warning">Ver todo</p></div>
                            <div class="col-6 text-end"><a href="#" class="btn btn-warning rounded-pill px-4 py-2 text-end">CONOCER HISTORIA</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="./assets/images/carrusel-3-promocion-30.webp" class="d-block w-100" alt="Imagen 3">
                <div class="carousel-caption d-none d-md-block custom-caption">
                    <h1 class="display-4 fw-bold text-white">OFERTA DE DESCUENTO EN <br> NUESTRO ESTRENO</h1>
                    <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-6"><p class="text-warning">Ver todo</p></div>
                            <div class="col-6 text-end"><a href="#" class="btn btn-warning rounded-pill px-4 py-2 text-end">SABER MÁS</a></div>
                        </div>
                    </div>                 
                </div>
            </div>
            <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>   
        </div>
    </div>

    <!-- Seccion 2 -->
    <section class="seccion-carne-argentina">
        <div class="container text-white py-5">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold">
                        La <span style="color: #dcb363;">carne argentina</span>,<br>
                        conoce un poco más<br>
                        sobre nuestro producto.
                    </h1>
                    <a href="#" class="btn btn-outline-warning rounded-pill mt-4 px-4 py-2">Conoce más</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Seccion 3 -->
    <section class="seccion-kobe">
        <div class="container d-flex align-items-center">
            <div class="imagen-kobe">
                <img src="./assets/images/carne-kobe.webp" alt="Carne Kobe" class="img-fluid">
            </div>
            <div class="texto-kobe">
                <h5 class="categoria">CARNE PREMIUM</h5>
                <h2>Carne Kobe, <br> una de las más exclusivas <br> y únicas del mundo</h2>
                <p class="descripcion">
                    Se llama buey de Kobe o ternera de Kobe a ciertos cortes de carne de ternera de ejemplares de la raza negra Tajima-ushi de vacuno Wagyu, criados de acuerdo a una estricta tradición en la prefectura de Hyogo (Japón).
                </p>
                <a href="#" id="section-3" class="btn">MIRA EL PRODUCTO</a>
            </div>
        </div>
    </section>

    <!-- Seccion 4 -->


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>