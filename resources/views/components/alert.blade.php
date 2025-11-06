@if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700" role="alert">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700" role="alert">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
