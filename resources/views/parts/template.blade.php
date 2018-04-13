<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Doppio+One|Roboto:100,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/css/app.css')}}">
    <link rel="icon" type="image/png" href="{{url('/images/logo2.png')}}" />

    <title>SB</title>
  </head>
  <body>

    <div class="webtobar">
        <div class="header_top_bar_a">
            <div class="container">
                <div class="row">
                <div class="col-md-12 text-right">
                    <ul>
                        <li>
                            <a href="{{url('/help')}}">Help</a>
                        </li>
                        <li>
                            <a href="{{url('/#register')}}">
                                Register
                            </a>
                        </li>
                        <li>
                            <div class="dropdown show">
                              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Curren: EN">
                                Change language
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">ES</a>
                                <a class="dropdown-item" href="#">DE</a>
                                <a class="dropdown-item" href="#">IT</a>
                              </div>
                            </div>
                        </li>
                        @if(\Auth::check())
                            <li>
                                <a href="{{url('/logouth')}}">
                                    Logouth
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                </div>
            </div>
        </div>



        <div class="header_top_bar_b">
            <div class="container">
                <div class="row">
                <div class="col-6 col-md-4 text-left logo_content">
                    <a href="{{url('/')}}">
                      <img src="{{url('/images/logo2.png')}}" class="logo" alt="Logo SB">
                    </a>
                </div>
                <div class="col-md-8 text-right menu">
                    <ul>
                        @include('parts.nav')
                    </ul>
                </div>

                <div class="col-6 menu-mobile-burger burger_content">
                    <div class="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div class="col-md-8 text-right menu-mobile">
                    <img src="{{url('/images/logo2.png')}}" class="logo" alt="Logo SB">
                    <div class="close">
                        x
                    </div>
                    <ul claa="offmenu">
                        @include('parts.nav')
                    </ul>
                </div>



                </div>
            </div>
        </div>
    </div>


    @yield('content')

    <div class="footer_page">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{url('/images/logo2.png')}}" class="logo" alt="Logo SB">
                    <p class="about">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat voluptatem quam, minus explicabo ea reiciendis quis voluptatibus dolorum.
                    </p>
                </div>

                <div class="col-md-2">
                    <h3>Navigation</h3>
                    <ul>
                        @include('parts.nav')
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3>
                        Popular routes
                    </h3>
                    <ul>
                        <li>
                            <a href="">
                                From Switzerland to Italy
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
    <script src="{{url('/js/sbb.js')}}"></script>

    <script>
        jQuery(document).ready(function($) {
            // Menu mobile
            $('.menu-mobile-burger .burger').on('click', function(){
                $('.menu-mobile').fadeIn(200).css('display','table');
                $('body').attr('style', 'overflow:hidden;');
            });

            $('.menu-mobile .close').on('click', function(){
                $('.menu-mobile').fadeOut(200);
                $('body').attr('style', '');
            });



            $('.openwalletqr').on('click', function(){
                $('.walletqr').fadeIn(200).css('display','table');
                $('body').attr('style', 'overflow:hidden;');
            });

            $('.walletqr .close').on('click', function(){
                $('.walletqr').fadeOut(200);
                $('body').attr('style', '');
            });

            // Scroll
            $('a[href*="#"]')
              // Remove links that don't actually link to anything
              .not('[href="#"]')
              .not('[href="#0"]')
              .click(function(event) {
                // On-page links
                if (
                  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                  &&
                  location.hostname == this.hostname
                ) {
                  // Figure out element to scroll to
                  var target = $(this.hash);
                  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                  // Does a scroll target exist?
                  if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                      scrollTop: target.offset().top
                    }, 1000, function() {
                      // Callback after animation
                      // Must change focus!
                      var $target = $(target);
                      $target.focus();
                      if ($target.is(":focus")) { // Checking if the target was focused
                        return false;
                      } else {
                        $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                      };
                    });
                  }
                }
              });
        });
    </script>
  </body>
</html>