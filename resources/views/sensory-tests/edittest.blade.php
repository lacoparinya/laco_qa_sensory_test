@if($agent->isMobile())
        @include('elements\m_edittest');
@else 
        @include('elements\d_edittest');
@endif