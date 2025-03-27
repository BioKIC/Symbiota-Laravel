@if(count($errors) > 0)
<div class="mb-4">
    @foreach ($errors->all() as $error)
    <div class="bg-error text-error-content rounded-md p-4">
        {{ $error }}
    </div>
    @endforeach
</div>
@endif
