@if(count($errors))
    <div class="form-group">

        <div class="aler alert-danger text-center">

            <ul>

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    </div>
@endif