<div class="card shadow-sm">
    <div class="card-body">
        @auth
            <div>
                <div class="row">
                    <div class="col-sm">
                        <resume-display-template-name-component></resume-display-template-name-component>
                    </div>

                    <div class="col-sm">
                        <div class="buttons text-right mt-1">
                            <div class="btn btn-outline-primary">
                                <i class="fa-download"></i>
                            </div>

                            <div class="btn btn-danger">
                                <i class="fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            </div>

            <div>
                @if (! empty($user) && $user->hasAnyRole(['administrator', 'moderator']))
                    <resume-assign-author-component></resume-assign-author-component>
                @else
                    <div class="py-2">
                        <div>
                            <div class="d-inline mr-2">
                                <img data-src="holder.js/45x45" class="rounded-circle" alt="45x45" style="width: 45px; height: 45px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1646211c6f3%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1646211c6f3%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274%22%20y%3D%22104.8%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            </div>

                            <div class="d-inline">
                                <span>{{ $author->name }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div>
                <div class="row">
                    <div class="col-sm">
                        <resume-display-template-name-component></resume-display-template-name-component>
                    </div>
                </div>

                <hr>
            </div>

            <div>
                <p class="lead">We can save resume to your cloud automatically.</p>

                <a class="btn btn-outline-primary" href="{{ route('register') }}">Get started</a>
            </div>
        @endauth
    </div>
</div>