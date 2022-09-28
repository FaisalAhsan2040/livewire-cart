<div class="max-w-lg mx-auto mt-2">
    @if (session()->has('success'))
        <div class="flex bg-green-100 text-sm text-white">
            {{session('session')}}
        </div>
    @endif

    @if (session()->has('error'))
    <div class="flex bg-red-100 text-sm text-white">
        {{session('session')}}
    </div>
@endif
</div>
