<div class="card">
    <div class="card-header">
        <h2>Maintenance Mode
            <small>Take the site offline for maintenance or bring it back online. Once activated, all public traffic
                   will see a <em>503 - Be Back Soon</em> page. As an administrator, you will
                   have full access to both the backend and frontend of the blog. Once you are ready to go live,
                   make the site active again by disabling maintenance mode.
            </small>
        </h2>
    </div>
    <div class="card-body card-padding">
        @if($data['status'] === \Canvas\Helpers\CanvasHelper::MAINTENANCE_MODE_DISABLED)
            <form class="form-inline" action="{!! route('canvas.admin.tools.enable_maintenance_mode') !!}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-primary btn-icon-text" id="maintenance_mode">
                    <i class="zmdi zmdi-alert-octagon"></i> Enable Maintenance Mode
                </button>
            </form>
        @else
            <form class="form-inline" action="{!! route('canvas.admin.tools.disable_maintenance_mode') !!}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-warning btn-icon-text" id="maintenance_mode">
                    <i class="zmdi zmdi-alert-octagon"></i> Disable Maintenance Mode
                </button>
            </form>
        @endif
    </div>
</div>