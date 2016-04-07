{!! Notification::showAll() !!}

@if (isset($errors) && $errors->any())
	<div class="alert alert-danger">
	    {!! implode('<br>', $errors->all()) !!}
	</div>
@endif