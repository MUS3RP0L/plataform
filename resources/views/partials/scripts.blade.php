
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

{!! Html::script('bower_components/data-tables/media/js/jquery.dataTables.min.js') !!}
{!! Html::script('bower_components/data-tables/media/js/dataTables.bootstrap.min.js') !!}
{!! Html::script('bower_components/knockout/dist/knockout.js') !!}
{!! Html::script('bower_components/bootstrap-combobox/js/bootstrap-combobox.js') !!}
{!! Html::script('bower_components/datePicker/js/bootstrap-datepicker.js') !!}
{!! Html::script('bower_components/Chart.js/Chart.js') !!}

<script type="text/javascript">	    $(document).ready(function(){		    $('[data-toggle="tooltip"]').tooltip();		});		$.ajaxSetup({	        headers: {	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	        }	    });    </script>	@if($errors->has())		<script type="text/javascript">	    	$(document).ready(function(){				$("#myModal-error").modal('show');			});       </script>    @endif    @if (Session::has('message'))		<script type="text/javascript">	    	$(document).ready(function(){				$("#myModal-message").modal('show');			});       </script>	@endif
