<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    setInterval(() => {
      var dt = new Date();
      // $("#autodiv").text(dt.getSeconds());
      $("#lonceng_active_user").load(location.href + " #lonceng_user");
      $("#notif_user_active").load(location.href + " #notif_user");
    }, 1000);
  });
</script>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="/"><strong>Aitixixi Electronics</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="mr-auto navbar-nav"></ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('landing') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('charts') }}">Keranjang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transaksi') }}">Transaksi</a>
        </li>
        <li class="nav-item dropdown">  
          <div class="dropdown">
            @if (Auth::user())	
            @php $user_notifikasi = App\Models\UserNotification::where('notifiable_id', Auth::user()->id)->where('read_at', NULL)->orderBy('created_at','desc')->get(); @endphp
            @php $user_unRead = App\Models\UserNotification::where('notifiable_id', Auth::user()->id)->where('read_at', NULL)->orderBy('created_at','desc')->count(); @endphp
            <a class="nav-link active dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-notify="{{$user_unRead}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Notifikasi 
              <div class="d-none">
                <span id="lonceng_user" class="badge bg-danger">{{$user_unRead}}</span>
              </div> 
              <span id="lonceng_active_user" class=""></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @forelse ($user_notifikasi as $notifikasi)
            @php $notif = json_decode($notifikasi->data); @endphp
            <div class="d-none">
              <a id="notif_user" class="dropdown-item" href="{{ route('notifikasi', $notifikasi->id) }}" class="dropdown-item btnunNotif" data-num="">
                <small>[{{ $notif->nama }}] {{ $notif->message }}</small>
              </a>
            </div>
            <div id="notif_user_active">

            </div>
            @empty
            <a class="dropdown-item" href="#" data-num=""><small>Tidak ada notifikasi</small></a>
            @endforelse
            </div>
            @else 
            {{-- <a class="nav-link" href="#">Notifikasi</a> --}}
            @endif
          </div>
        </li>
        @if(Auth::check())
          <li class="nav-item dropdown">  
            <div class="dropdown">
              <a class="nav-link active dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                {{ Auth::user()->user_name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{ route('userprofile') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                  document.getElementById('logout-form').submit();">Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>