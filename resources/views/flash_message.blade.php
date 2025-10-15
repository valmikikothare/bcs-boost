 @if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible" role="alert" >
  <strong>{{ $message }}</strong>
</div>
@endif 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script> 
       $(document).ready(function(){
        setTimeout(function(){
        $('.alert').fadeOut('slow');
        }, 5000); // 3000 milliseconds = 3 seconds
        });
</script> 
  