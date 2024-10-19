<!-- generic/action.blade.php -->
<div class="ic-action-wrapper">
    <div class="ic-action">
        <a href="{{ $routeShow }}"><i class="ri-eye-line"></i></a>
    </div>
    <div class="ic-action">
        <a href="{{ $routeEdit }}"><i class="ri-pencil-line"></i></a>
    </div>
    <div class="ic-action">
        <form action="{{ $routeDestroy }}" id="delete-form-{{ $item->id }}" method="post" style="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
            <button onclick="return makeDeleteRequest(event, {{ $item->id }})" type="submit">
                <i class="ri-delete-bin-6-line"></i>
            </button>
        </form>
    </div>
</div>
