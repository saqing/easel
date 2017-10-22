<div class="panel-heading" role="tab" id="headingTwo">
    <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <span class="c-blue">Known Issues with Proengsoft</span>
            <small>October 26, 2016</small>
        </a>
    </h4>
</div>
<div id="collapseTwo" class="collapse" role="tabpanel"
     aria-labelledby="headingTwo">
    <div class="panel-body">
        <a href="https://github.com/laravel/framework/releases/tag/v5.3.21" target="_blank">Laravel v5.3.21</a>
        just came out and changed the way validations are handled slightly. Unfortunately, that broke the
        <a href="http://laravel-jsvalidation.memorylimit.net" target="_blank">LaravelJS Validation package</a> that Canvas uses. We've been closely watching an
        <a href="https://github.com/proengsoft/laravel-jsvalidation/issues/190" target="_blank">open issue</a> that will
        hopefully be resolved as soon as possible. Until that time, Canvas is stuck using Laravel <code>v5.3.20</code>.
    </div>
</div>