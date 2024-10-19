<nav class="ic-breadcrumb-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        @if ($title['submenus'] != null)
            <li class="breadcrumb-item"><a href="#">{{ $title['submenus'] ?? '' }}</a></li>
        @endif
        <li class="breadcrumb-item"><a href="#">{{ $title['page_title'] ?? '' }}</a></li>
    </ol>
</nav>
