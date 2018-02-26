<section class="x-dashboard">
    @if (Auth::check())
        <div class="x-dashboard__info">
            <span class="x-dashboard__info_who"> @lang('home/home.logged_in_as'): {{ obfuscate_email('nkt.millers+test@email.com') }}</span>
            <span class="x-dashboard__info_tokens">12.212312 TOK</span>
        </div>
        <div class="x-dashboard__tabs">
            <ul class="nav nav-tabs">
                <li class="active"> <a data-toggle="tab" href="#tokenSell">@lang('home/home.token_sale')</a> </li>
                <li> <a data-toggle="tab" href="#myTokens">@lang('home/home.my_transactions')</a> </li>
            </ul>
        </div>
        <div class="x-dashboard__options">
            <a href="" class="x-dashboard__options_out"><img src="{{ asset('img/logout.png') }}" alt="logout">@lang('home/home.log_out')</a>
            <a href="" class="x-dashboard__options_email">@lang('home/home.change_email')</a>
            <a href="" class="x-dashboard__options_password">@lang('home/home.change_password')</a>
        </div>
    @else
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            @lang('app.sign_up')
        </button>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
            @lang('app.sign_in')
        </button>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
            @lang('home/login.forgot_pwd')
        </button>
    @endif
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                @include('auth.register')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                @include('auth.login')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                @include('auth.passwords.email')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>