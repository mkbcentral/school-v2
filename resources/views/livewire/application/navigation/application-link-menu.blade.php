<div class="container pt-4 ">
    <div>
        <img class="" src="{{asset('logo-white.png')}}" alt="Logo">
    </div>
    <div class="row mt-4">
        @foreach (Auth::user()?->appLinks as $appLink)
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ route($appLink?->link, $appLink) }}" wire:navigate>
                    <div class="info-box">
                        <span class="info-box-icon {{$appLink?->color}} elevation-1">
                            <i class="fas {{ $appLink->icon }}"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-number">
                                {{ $appLink?->name }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
        @endforeach
        @can('view-administration-panel')
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="/app-configration" target="_blank" wire:navigate>
                        <div class="info-box">
                        <span class="info-box-icon bg-dark elevation-1">
                            <i class="fas fas fa-user-cog"></i>
                        </span>
                            <div class="info-box-content">
                            <span class="info-box-number">
                               Adminstration
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('settings.app.links')}}" wire:navigate>
                        <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1">
                            <i class="fas fas fa-paperclip"></i>
                        </span>
                            <div class="info-box-content">
                            <span class="info-box-number">
                               Accès au menu
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
        @endcan
        @can('view-links-settings')
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="/app-configration" target="_blank" wire:navigate>
                        <div class="info-box">
                        <span class="info-box-icon bg-dark elevation-1">
                            <i class="fas fas fa-user-cog"></i>
                        </span>
                            <div class="info-box-content">
                            <span class="info-box-number">
                               Adminstration
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
        @endcan
    </div>
</div>
