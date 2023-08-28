<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <title>{{ $title ? $title.' - SegzyKay Media Concept' : 'SegzyKay Media Concept' }}</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    var pusher = new Pusher('37e6761c4951fa973cad', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('new-participant');
    channel.bind('notify-new-participant', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>

<body data-spy="scroll" data-target="#main-nav" id="home">
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" id="main-nav">
    <div class="container">
      <a href="index.html" class="navbar-brand">SegzyKay</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="#home" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#explore-section" class="nav-link">Wedding</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('participants.index')}}" class="nav-link">Models</a>
          </li>
          <li class="nav-item">
            <a href="#share-section" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="#share-section" class="nav-link">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @if(session('success'))
    <div class="alert alert-success mt-2 w-25 mx-auto text-center" id="alert" style="z-index: 50000000;">
      <p>{{ session('success') }}</p>
    </div>
  @endif

  <!-- HOME SECTION -->
  <section class="">
  	@yield('content')
  </section>

  <!-- FOOTER -->
  <footer id="main-footer" class="bg-dark">
    <div class="container">
      <div class="row">
        <div class="col text-center py-4">
          <p> &copy; <span id="year"></span> SegzyKay Media Concept &TRADE;
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- CONTACT MODAL -->
  <div class="modal fade text-dark" id="contactModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Contact Us</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-block">Submit</button>
        </div>
      </div>
    </div>
  </div>
 
  <script src="{{ url('js/jquery.js') }}"></script>
  <script src="{{ url('js/bootstrap.js') }}"></script>
  <script src="{{ url('js/popper.js') }}"></script>

  <script>
    let alert = document.getElementById('alert');
    if(alert) {
      console.log(alert);
      setTimeout(() => alert.style.display = 'none', 4000);
    }

    $('#year').text(new Date().getFullYear());

    // Init Scrollspy
    $('body').scrollspy({ target: '#main-nav' });

    // Smooth Scrolling
    $("#main-nav a").on('click', function (event) {
      if (this.hash !== "") {
        event.preventDefault();

        const hash = this.hash;

        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function () {

          window.location.hash = hash;
        });
       }
      });
  
  </script>
</body>

</html>