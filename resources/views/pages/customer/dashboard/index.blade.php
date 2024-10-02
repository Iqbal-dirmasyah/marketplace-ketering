<form action="{{ route('pages.auth.logout') }}" method="POST">
    @csrf
    <button type="submit" >logout</button>
</form>