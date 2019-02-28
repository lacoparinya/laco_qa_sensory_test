    @if($agent->isMobile())
        @include('elements\mruntest');
@else 
        @include('elements\druntest');
@endif

