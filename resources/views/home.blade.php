this is home page

<form method="post" action="{{ route('logout') }}">
	@csrf
	<input type="submit" name="logout" value="Logout" class="btn btn-default btn-sm">
</form>