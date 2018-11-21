@if(Session::has('success'))
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-success text-center">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    </div>
@elseif(Session::has('warning'))
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-warning text-center">
                    {{ Session::get('warning') }}
                </div>
            </div>
        </div>
    </div>
@elseif(Session::has('error'))
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center">
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    </div>
@endif