<ul class="menu">
    <li><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/contact">Contact</a></li>
    <li><a href="/gallery">Gallery</a></li>
    @auth
   <!-- <li><a href="/history">History</a></li>-->
    <li><a href="{{ route('calculator.form')}}">Calculator App</a></li>
    @endauth
    @guest
    <li><a href="{{ route('login')}}">Login</a></li>

    @endguest

</ul>
    @auth
        <form action="{{ route('logout')}}" method="post">
            @csrf
            <button  type="submit" style="padding: 10px 15px;background:red; margin:10px 0px;border-radius:10px;border:0px;font-family: Times new roman;color:blue;font-size:15px">Logout</button>
        </form>
  
    @endauth