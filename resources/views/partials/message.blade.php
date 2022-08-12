@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{!! session('success') !!}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{!! session('error') !!}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('admin_login_error'))
<div class="alert alert-error alert-block" style="background-color:red">
    <button type="button" class="close" data-dismiss="alert" style="color:#fff;">×</button> 
        <strong style="color:#fff;">{!! session('error') !!}</strong>
</div>
@endif