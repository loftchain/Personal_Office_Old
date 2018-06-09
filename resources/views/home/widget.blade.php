<section class="x-widget">

<div class="widget-part x-widget__top">
        <p class="js__stage-name-title">До конца ICO:</p>
        <div class="control-container">
          <div class="control-container__periods">
            <div class="c c1 c1-0">
                <div class="x-progress c1__progress_pre-sale">
                    <div class="x-in x-progress__in_pre-sale"></div>
                    <span class="x-stage js__stage_pre-sale">Pre-Sale</span>
                    <div class="x-progress_dates">
                        <span class="dates__start_pre-sale">20.01.18</span>
                        <span class="dates__end_pre-sale">21.02.18</span>
                    </div>
                </div>
                <div class="x-progress c1__progress_pre-ico">
                    <div class="x-in x-progress__in_pre-ico"></div>
                    <span class="x-stage js__stage-pre-ico">Pre-ICO</span>
                    <div class="x-progress_dates">
                        <span class="dates__start_pre-ico">20.03.18</span>
                        <span class="dates__end_pre-ico">21.05.18</span>
                    </div>
                </div>
            </div>
            <div class="c c1 c1-1">
              <div class="x-progress c1-1__progress_ico1">
                <div class="x-in x-progress__in_ico1"></div>
                <span class="x-stage js__stage_ico1">ICO 1</span>
                <div class="x-progress_dates">
                  <span class="dates__start_ico1">20.01.18</span>
                  <span class="dates__end_ico1">21.02.18</span>
                </div>
              </div>
              <div class="x-progress c1-1__progress_ico2">
                <div class="x-in x-progress__in_ico2"></div>
                <span class="x-stage js__stage_ico2">ICO 2</span>
                <div class="x-progress_dates">
                  <span class="dates__start_ico2">20.01.18</span>
                  <span class="dates__end_ico2">21.02.18</span>
                </div>
              </div>
              <div class="x-progress c1-1__progress_ico3">
                <div class="x-in x-progress__in_ico3"></div>
                <span class="x-stage js__stage-ico3">ICO 3</span>
                <div class="x-progress_dates">
                  <span class="dates__start_ico3">20.03.18</span>
                  <span class="dates__end_ico3">21.05.18</span>
                </div>
              </div>
            </div>
          </div>
          <div class="c c2">
              <div class="d d1">
                  <span class="t js__dd">12</span>
                  <span class="d__name js__dd-name">@lang('home/widget.days_span')</span>
              </div>
              <div class="d d2">
                  <span class="t js__hh">18</span>
                  <span class="d__name js__hh-name">@lang('home/widget.hours_span')</span>
              </div>
              <div class="d d3">
                  <span class="t js__mm">59</span>
                  <span class="d__name js__mm-name">@lang('home/widget.minutes_span')</span>
              </div>
          </div>
        </div>
</div>
    <div class="widget-part x-widget__bot">
        <p>@lang('home/widget.raised')</p>
        <div class="control-container">
            <div class="c c1">
                <div class="x-progress">
                    <div class="x-progress__in"></div>
                    <span class="x-progress__percents">55%</span>
                    <div class="x-progress__caps">
                      <div>
                        <span class="js_eth_currently_collected">555 ETH (total)</span>
                      </div>
                      <div>
                        <span class="js_eth_soft_cap">100 (soft cap)</span>
                        <span class="js_eth_hard_cap">500 (hard cap)</span>
                      </div>
                    </div>
                </div>
            </div>

            <div class="c c2">
                <div class="c2__cur">
                    <img class="c2__cur_img0" src="{{ asset('img/Ethereum.png') }}" alt="">
                    <div class="tb0 text-box">
                        <span class="a0 amount">70</span>
                        <span class="n0 name">ETH</span>
                    </div>
                </div>
                <div class="c2__cur">
                    <img class="c2__cur_img1" src="{{ asset('img/Bitcoin.png') }}" alt="">
                    <div class="tb1 text-box">
                        <span class="a1 amount">46.30</span>
                        <span class="n1 name">BTC</span>
                    </div>
                </div>
                {{--<div class="c2__cur">--}}
                  {{--<img class="c2__cur_img2" src="{{ asset('img/USD.png') }}" alt="">--}}
                  {{--<div class="tb2 text-box">--}}
                    {{--<span class="a2 amount">{{ number_format(env('INVESTED_IN_USD'), 0, '.', ' ') }}</span>--}}
                    {{--<span class="n2 name">USD</span>--}}
                  {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</section>