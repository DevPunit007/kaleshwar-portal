<div class="modal fade" id="appMenu" tabindex="-1" role="dialog" aria-labelledby="appMenu" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row m-0">
                    <div class="col-md-12 p-4">
                        <div class="menu-icon-grid w-auto p-0">

                            <a href="{{ route('file-list', app()->getLocale()) }}">
                                <i class="fal fa-folder-open fa-2x mb-2"></i>{{ __('admin-main-manu.media_center') }}
                            </a>

                            <a href="{{ route('timeline-media-list', app()->getLocale()) }}">
                                <i class="fal fa-photo-video fa-2x mb-2"></i>{{ __('admin-main-manu.timeline') }}
                            </a>

                            {{-- <a class="generic-modal" data-url="{{action('AuditsController@index', app()->getLocale())}}" data-modal-width="modal-xl"> --}}
                            <a href="#">
                                <i class="fal fa-file-chart-line fa-2x mb-2"></i>{{ __('admin-main-manu.reports') }}
                            </a>
                            <a href="#">
                                <i class="fal fa-file-invoice-dollar fa-2x mb-2"></i>{{ __('admin-main-manu.payments') }}
                            </a>
                            <a href="{{ route('translation-list', app()->getLocale()) }}">
                                <i class="fal fa-globe fa-3x mb-2"></i>{{ __('admin-main-manu.translations') }} 
                            </a>
                            @if(auth()->user()->rule_id === 5)
                                <a href="{{-- route('mail-send-users', app()->getLocale()) --}}" id="newsletter-admin">
                                    <i class="fal fa-mail-bulk fa-3x mb-2"></i>Newsletter Test
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
