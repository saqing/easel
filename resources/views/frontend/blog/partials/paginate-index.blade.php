<ul class="pager">
    {{-- Reverse direction --}}
    @if ($reverse_direction)
        @if ($posts->currentPage() > 1)
            <li class="previous">
                <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                    <i class="fa fa-angle-left fa-lg"></i>
                    Previous {{ $tag->tag }}
                </a>
            </li>
        @endif
        @if ($posts->hasMorePages())
            <li class="next">
                <a href="{!! $posts->nextPageUrl() !!}">
                    Next {{ $tag->tag }}
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        @endif
    @else
        @if ($posts->currentPage() > 1)
            <li class="previous">
                <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                    <i class="fa fa-angle-left fa-lg"></i>
                    Newer {{ $tag ? $tag->tag : '' }}
                </a>
            </li>
        @endif
        @if ($posts->hasMorePages())
            <li class="next">
                <a href="{!! $posts->nextPageUrl() !!}">
                    Older {{ $tag ? $tag->tag : '' }}
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        @endif
    @endif
</ul>