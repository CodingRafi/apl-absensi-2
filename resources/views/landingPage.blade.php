<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        .container, .navbar{
            min-width: 100%;
            max-width: 100%;
        }
        .nav-link{
            text-decoration: none;
        }
        .nav-link:hover{
            color: white;
            font-weight: 500;
            transition: 100ms;
        }
        .btn-light{
            color: #41D4BD;
        }
        .btn-light:hover{
            background-color: #005c4e;
            color: #fff;
            border: #005c4e;
        }
        @media (max-width: 480px){
            .absensi{
                font-size: 50px;
            }
            .tapping{
                width: 20rem;
                float: right;
            }
            .navbar{
                padding: 0!important;
            }
            .navbar-collapse{
                text-align: left;
                margin-bottom: 10px;
            }
            .btn-light{
                width: 5rem;
            }
        }
        @media (min-width: 480px){
            .absensi{
                font-size: 90px;
            }
        }
    </style>

    <title>Go Tap Landing Page</title>
  </head>
  <body>
    <div class="container p-0">
        <div class="session1 px-5" id="home" style="height: 100vh;">
            {{-- navbar --}}
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid mt-1 mb-1">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse mt-3" id="navbarNavAltMarkup">
                    <div class="navbar-nav me-auto">
                        <img src="{{ asset('img/gotap-logo.svg') }}" alt="" style="width: 5rem;">
                    </div>
                    <div class="navbar-nav gap-5">
                      <a class="nav-link active" aria-current="page" href="/" style="color: #9B9B9B; font-weight: 600;">Home</a>
                      <a class="nav-link" href="#aboutUs" style="color: #9B9B9B; font-weight: 600;">About Us</a>
                      <a class="nav-link" href="#features" style="color: #9B9B9B; font-weight: 600;">Features</a>
                      <a class="nav-link" href="#faq" style="color: #9B9B9B; font-weight: 600;">FAQ</a>
                    </div>
                    <div class="navbar-nav ms-auto gap-3">
                        <form action="{{ route('login') }}">
                            <button style="background-color: transparent; border: none;"><img src="{{ asset('img/login-logo.svg') }}" alt=""></button>
                        </form>
                    </div>
                  </div>
                </div>
            </nav>
            {{-- end navbar --}}
            {{-- content --}}
            <div class="content p-3">
                <div class="row m-0 p-0">
                    <div class="col-lg-8 p-0" style="margin-top: 50px;">
                        <h1 class="text-left text-dark absensi" style="line-height: 70px">
                            <span class="fw-medium" style="font-size: 5rem">ABSENSI</span>
                            <br>
                            <span class="fw-bold" style="font-size: 5rem">TAPPING CARD</span>
                        </h1>
                        <h2 class="text-left" style="color: #9B9B9B;">Your solution to absenteeism <br> easily and quickly</h2>
                        <button class="btn text-dark mt-3" style="border: 2px solid black; border-radius: 8px;">
                            <i class="bi bi-play-circle-fill"></i> WATCH DEMO
                        </button>
                        <div class="mt-5">
                            <img src="{{ asset('img/arrow-down.svg') }}" alt="">
                            <span class="fw-bold">Scroll down to explore</span>
                        </div>
                    </div>
                    <img class="col-lg-4 p-0 tapping" style="margin-top: 50px;" src="{{ asset('img/tap.svg') }}" alt="logo">
                </div>
            </div>
            {{-- end content --}}
        </div>
        <div class="session2 px-5 py-5" id="aboutUs" style="background-color: #E7E7E7; height: 100vh;">
            <div class="row px-3">
                <div style="color: black; border-left: 3px solid black;"><h2>About Us</h2></div>
                <span style="color: #9B9B9B;"><h6>Your solution to absenteeism <br> easily and quickly</h6></span>
            </div>
            <div class="row">
                <div class="col-lg-6" style="text-align: justify;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut quisquam cumque temporibus animi accusamus eveniet soluta consectetur voluptatem, porro nesciunt aliquid fugiat magni enim, atque voluptatum explicabo voluptate consequuntur officiis. Aspernatur vero aut rerum commodi debitis! Doloremque ab harum optio quos accusantium quibusdam quisquam dolor nobis minima, laborum eveniet at, quas provident similique tempore nam repellat? Veniam, obcaecati natus? Ex praesentium dolor magni sint eaque est consectetur nisi ratione eos! Quibusdam, illo. Odio nemo quod mollitia itaque accusantium quasi porro saepe repellat aspernatur dicta, perspiciatis cumque illo eligendi praesentium corrupti. Quos accusamus ea debitis obcaecati aliquid velit vel vero assumenda molestiae, voluptatem eveniet odit expedita, corporis asperiores, nam reprehenderit quidem. Dicta, eaque hic! Esse velit iusto distinctio, error unde dolorem illum molestiae, similique architecto incidunt, cupiditate officia aut? Alias maxime excepturi assumenda possimus cumque suscipit, iste minus officiis eveniet laborum dolores placeat praesentium exercitationem nulla similique animi amet commodi blanditiis.
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('img/tap-2.svg') }}" alt="">
                </div>
            </div>
        </div>
        <div class="session3 px-5 py-5" id="features" style="height: 100vh;">
            <div class="row px-3">
                <div style="color: black; border-left: 3px solid black;"><h2>Features</h2></div>
                <span style="color: #9B9B9B;"><h6>Your solution to absenteeism <br> easily and quickly</h6></span>
            </div>
        </div>
        <div class="session4 px-5 py-5" id="faq" style="background-color: #E7E7E7; height: 100vh;">
            <div class="row px-3">
                <div style="color: black; border-left: 3px solid black;"><h2>FAQ</h2></div>
                <span style="color: #9B9B9B;"><h6>Your solution to absenteeism <br> easily and quickly</h6></span>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample" style="background-color: transparent;">
                <div class="accordion-item" style="background-color: transparent;">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background-color: transparent;">
                      Accordion Item #1
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="border-bottom: 1px solid black; border-radius: 0">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                  </div>
                </div>
              </div>
        </div>
        <div class="session5 px-5 py-5" id="footer" style="background-color: black; color: #ffffff;">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Open Designers</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam harum eligendi provident minima rem praesentium veniam? Voluptas dolore reprehenderit eaque cum.</p>
                    <div class="sosialMedia d-flex gap-5">
                        <a href="#" style="color: #ffffff;"><i class="bi bi-discord"></i></a>
                        <a href="#" style="color: #ffffff;"><i class="bi bi-instagram"></i></a>
                        <a href="#" style="color: #ffffff;"><i class="bi bi-facebook"></i></a>
                        <a href="#" style="color: #ffffff;"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg">
                    <h3>Explore</h3>
                    <ul style="line-height: 40px; list-style: none;">
                        <li>Go Pro</li>
                        <li>Explore Designs</li>
                        <li>Create Designs</li>
                        <li>Playoffs</li>
                    </ul>
                </div>
                <div class="col-lg">
                    <h3>Innovate</h3>
                    <ul style="line-height: 40px; list-style: none;">
                        <li>Tags</li>
                        <li>API</li>
                        <li>Places</li>
                        <li>Creative Markets</li>
                    </ul>
                </div>
                <div class="col-lg">
                    <h3>About</h3>
                    <ul style="line-height: 40px; list-style: none;">
                        <li>Community</li>
                        <li>Designers</li>
                        <li>Support</li>
                        <li>Terms of Service</li>
                    </ul>
                </div>
            </div>
        </div>
        <footer class="footer fixed-bottom bg-white w-100" style="border-top: 2px solid #6c757d8a;">
            <div class="container-fluid">
                <div class="text-center mt-2 mb-2">
                    <span class="text-muted">All rights reserved</span>
                </div>
            </div>
        </footer>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>