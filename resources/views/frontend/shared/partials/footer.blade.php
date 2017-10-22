<div class="container">
    @if(!empty(\Canvas\Models\Settings::disqus()))
        @include('canvas::frontend.blog.partials.disqus')
    @endif
    @if(!empty(\Canvas\Models\Settings::changyanAppid()) && !empty(\Canvas\Models\Settings::changyanConf()))
        @include('canvas::frontend.blog.partials.changyan')
    @endif
    <div style="text-align: center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <hr>
                <p class="small">Proudly powered by <a href="https://cnvs.io" target="_blank">Canvas</a> &#183; <a href="{!! route('canvas.admin') !!}"><i class="fa fa-lock"></i> Sign In</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- scroll to top button -->
<span id="top-link-block" class="hidden hover-button">
    <a id="scroll-to-top" href="#top">SCROLL TO TOP</a>
</span>

@if (!empty(\Canvas\Models\Settings::gaId()))
    @include('canvas::frontend.blog.partials.analytics')
@endif