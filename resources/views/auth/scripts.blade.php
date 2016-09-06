
{!! Html::script('plugins/jQuery/jquery-2.2.3.min.js') !!}

{!! Html::script('js/bootstrap.min.js') !!}

@if (Session::has('error'))
	<script type="text/javascript">
    	$(document).ready(function(){
			$("#myModal-error").modal('show');
		});
   </script>
@endif
