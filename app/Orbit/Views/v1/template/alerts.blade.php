@if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has("error"))
    <div class="alert alert-danger">
        <p class="mb-0">{{ session()->get("error") }}</p>
    </div>
@endif
@if(session()->has("warning"))
    <div class="alert alert-warning">
        <p class="mb-0">{{ session()->get("warning") }}</p>
    </div>
@endif
@if(session()->has("info"))
    <div class="alert alert-info">
        <p class="mb-0">{{ session()->get("info") }}</p>
    </div>
@endif
@if(session()->has("success"))
    <div class="alert alert-success">
        <p class="mb-0">{{ session()->get("success") }}</p>
    </div>
@endif
