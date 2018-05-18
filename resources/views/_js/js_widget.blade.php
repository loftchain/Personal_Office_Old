<script>
    let w = {
        tokenName: '{{ env('TOKEN_NAME') }}',

        startDate_preSale: '{{ env('PRE_SALE_START') }}',
        endDate_preSale: '{{ env('PRE_SALE_END') }}',
        startDate_preIco: '{{ env('PRE_ICO_START') }}',
        endDate_preIco: '{{ env('PRE_ICO_END') }}',
        startDate_ico1: '{{ env('ICO1_START') }}',
        endDate_ico1: '{{ env('ICO1_END') }}',
        startDate_ico2: '{{ env('ICO2_START') }}',
        endDate_ico2: '{{ env('ICO2_END') }}',
        startDate_ico3: '{{ env('ICO3_START') }}',
        endDate_ico3: '{{ env('ICO3_END') }}',

        tokenPriceInETH: '{{ $data['stageInfo']['tokenPriceInETH'] }}',
        softCapETH: '{{ $data['stageInfo']['softCapETH'] }}',
        hardCapETH: '{{ $data['stageInfo']['hardCapETH'] }}',
        softCapToken: '{{ $data['stageInfo']['softCapToken'] }}',
        hardCapToken: '{{ $data['stageInfo']['hardCapToken'] }}',
        minPayment: '{{ $data['stageInfo']['minPayment'] }}',
        currentStage: '{{ $data['stageInfo']['currentStage'] }}',
        nextStage: '{{ $data['stageInfo']['nextStage'] }}',
        walletETH: '{{ $data['stageInfo']['walletETH'] }}',
        walletBTC: '{{ $data['stageInfo']['walletBTC'] }}',

        _now: ('{{ $data['time'] }}') ? '{{ $data['time'] }}' : Math.floor(new Date().getTime() / 1000),
        ethCurrentAmount: ('{{ $data['ethCurrentAmount']['currency'] }}'),
        ethCurrentAmountETH: ('{{ $data['ethCurrentAmount']['eth'] }}'),
        ethCurrentAmountToken: ('{{ $data['ethCurrentAmount']['token'] }}'),
        btcCurrentAmount: ('{{ $data['btcCurrentAmount']['currency'] }}'),
        btcCurrentAmountETH: ('{{ $data['btcCurrentAmount']['eth'] }}'),
        btcCurrentAmountToken: ('{{ $data['btcCurrentAmount']['token'] }}'),
        totalCryptoAmountETH: ('{{ $data['totalCryptoAmount'][1] }}'),
        totalCryptoAmountToken: ('{{ $data['totalCryptoAmount'][2] }}'),

        currentStageTitle: $('.js__stage-name-title'),

        preStageTitle: $('.js__stage_pre-sale'),
        icoStageTitle: $('.js__stage-pre-ico'),

        startSpan_preSale: $('.dates__start_pre-sale'),
        endSpan_preSale: $('.dates__end_pre-sale'),
        startSpan_preIco: $('.dates__start_pre-ico'),
        endSpan_preIco: $('.dates__end_pre-ico'),
        startSpan_ico1: $('.dates__start_ico1'),
        endSpan_ico1: $('.dates__end_ico1'),
        startSpan_ico2: $('.dates__start_ico2'),
        endSpan_ico2: $('.dates__end_ico2'),
        startSpan_ico3: $('.dates__start_ico3'),
        endSpan_ico3: $('.dates__end_ico3'),

        innerProgress_preSale: $('.x-progress__in_pre-sale'),
        innerProgress_preIco: $('.x-progress__in_pre-ico'),
        innerProgress_ico1: $('.x-progress__in_ico1'),
        innerProgress_ico2: $('.x-progress__in_ico2'),
        innerProgress_ico3: $('.x-progress__in_ico3'),

        dd: $('.js__dd'),
        hh: $('.js__hh'),
        mm: $('.js__mm'),
        ddName: $('.js__dd-name'),
        hhName: $('.js__hh-name'),
        mmName: $('.js__mm-name'),
        
        currentlyCollectedSpan_ETH: $('.js_eth_currently_collected'),
        softCapSpan_ETH: $('.js_eth_soft_cap'),
        hardCapSpan_ETH: $('.js_eth_hard_cap'),
        
        totalInnerProgress: $('.x-progress__in'),
        totalInnerPercents: $('.x-progress__percents'),
        
        currencyValue0: $('.a0'),
        currencyName0: $('.n0'),
        currencyValue1: $('.a1'),
        currencyName1: $('.n1'),

        preProgressContainer: $('.c1-0'),
        icoProgressContainer: $('.c1-1'),

        setStage() {
            switch (true) {
                case w.currentStage === 'pre_sale':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeEnd_js') }} pre-Sale');
                    w.diffStage = w.endDate_preSale - w._now;
                    w.setInnerWidth('pre_sale');
                    w.preProgressContainer.show();
                    w.icoProgressContainer.hide();
                    break;
                case w.currentStage === 'pre_ico':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeEnd_js') }} pre-ICO');
                    w.diffStage = w.endDate_preIco - w._now;
                    w.setInnerWidth('pre_ico');
                    w.preProgressContainer.show();
                    w.icoProgressContainer.hide();
                    break;
                case w.currentStage === 'ico1':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeEnd_js') }} ICO 1');
                    w.diffStage = w.endDate_ico1 - w._now;
                    w.setInnerWidth('ico1');
                    w.preProgressContainer.hide();
                    w.icoProgressContainer.show();
                    break;
                case w.currentStage === 'ico2':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeEnd_js') }} ICO 2');
                    w.diffStage = w.endDate_ico2 - w._now;
                    w.setInnerWidth('ico2');
                    w.preProgressContainer.hide();
                    w.icoProgressContainer.show();
                    break;
                case w.currentStage === 'ico3':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeEnd_js') }} ICO 3');
                    w.diffStage = w.endDate_ico3 - w._now;
                    w.setInnerWidth('ico3');
                    w.preProgressContainer.hide();
                    w.icoProgressContainer.show();
                    break;
                //------------------------------------------------------------------------------
                case w.nextStage === 'pre_sale':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeStart_js') }} pre-Sale');
                    w.diffStage = w.startDate_preSale - w._now;
                    w.setInnerWidth('pre_sale_next');
                    w.preProgressContainer.show();
                    w.icoProgressContainer.hide();
                    break;
                case w.nextStage === 'pre_ico':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeStart_js') }} pre-ICO');
                    w.diffStage = w.startDate_preIco - w._now;
                    w.setInnerWidth('pre_ico_next');
                    w.preProgressContainer.show();
                    w.icoProgressContainer.hide();
                    break;
                case w.nextStage === 'ico1':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeStart_js') }} ICO 1');
                    w.diffStage = w.startDate_ico1 - w._now;
                    w.setInnerWidth('ico1_next');
                    w.preProgressContainer.hide();
                    w.icoProgressContainer.show();
                    break;
                case w.nextStage === 'ico2':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeStart_js') }} ICO 2');
                    w.diffStage = w.startDate_ico2 - w._now;
                    w.setInnerWidth('ico2_next');
                    w.preProgressContainer.hide();
                    w.icoProgressContainer.show();
                    break;
                case w.nextStage === 'ico3':
                    w.currentStageTitle.text('{{ __('_home/widget.beforeStart_js') }} ICO 3');
                    w.diffStage = w.startDate_ico3 - w._now;
                    w.setInnerWidth('ico3_next');
                    w.preProgressContainer.hide();
                    w.icoProgressContainer.show();
                    break;
                case w.currentStage === 'finish':
                    w.diffStage = 0;
                    w.setInnerWidth('finish');
                    w.currentStageTitle.text('{{ __('_home/widget.crowdSaleFinished_js') }}');
                    w.preProgressContainer.hide();
                    w.icoProgressContainer.hide();
                    break;
            }
        },

        setInnerWidth(stage) {
            switch (stage) {
                case 'pre_sale':
                    w.innerProgress_preSale.css('width', 'calc(' + w.calcInnerWidth(w.startDate_preSale, w.endDate_preSale) + '% + 2px)');
                    w.innerProgress_preIco.css('width', '0');
                    w.innerProgress_ico1.css('width', '0');
                    w.innerProgress_ico2.css('width', '0');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'pre_ico':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(' + w.calcInnerWidth(w.startDate_preIco, w.endDate_preIco) + '% + 2px)');
                    w.innerProgress_ico1.css('width', '0');
                    w.innerProgress_ico2.css('width', '0');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'ico1':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico1.css('width', 'calc(' + w.calcInnerWidth(w.startDate_ico1, w.endDate_ico1) + '% + 2px)');
                    w.innerProgress_ico2.css('width', '0');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'ico2':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico1.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico2.css('width', 'calc(' + w.calcInnerWidth(w.startDate_ico2, w.endDate_ico2) + '% + 2px)');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'ico3':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico1.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico2.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico3.css('width', 'calc(' + w.calcInnerWidth(w.startDate_ico3, w.endDate_ico3) + '% + 2px)');
                    break;
//-------------------------------------------------------------------------------------------------------------------------------------
                case 'pre_sale_next':
                    w.innerProgress_preSale.css('width', '0');
                    w.innerProgress_preIco.css('width', '0');
                    w.innerProgress_ico1.css('width', '0');
                    w.innerProgress_ico2.css('width', '0');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'pre_ico_next':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', '0');
                    w.innerProgress_ico1.css('width', '0');
                    w.innerProgress_ico2.css('width', '0');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'ico1_next':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico1.css('width', '0');
                    w.innerProgress_ico2.css('width', '0');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'ico2_next':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico1.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico2.css('width', '0');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'ico3_next':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico1.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico2.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico3.css('width', '0');
                    break;
                case 'finish':
                    w.innerProgress_preSale.css('width', 'calc(100% + 2px)');
                    w.innerProgress_preIco.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico1.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico2.css('width', 'calc(100% + 2px)');
                    w.innerProgress_ico3.css('width', 'calc(100% + 2px)');
                    break;
            }
        },

        calcInnerWidth(start, end) {
            let wholePeriodInDays = Math.floor(w.daysInUTC(end - start));
            let currentPeriodInDays = Math.floor(w.daysInUTC(w._now - start));
            return Math.floor(currentPeriodInDays * 100 / wholePeriodInDays);
        },

        addZero(num) {
            return num > 9 ? num : '0' + num;
        },

        daysInUTC(utc) {
            return Math.floor(utc / 86400) //24*60*60
        },

        getSmallDate(param) {
            let milliUTC = param * 1000,
                o = new Date(milliUTC).getTimezoneOffset(),
                d = new Date((milliUTC + o * 60000)),
                date = w.addZero(d.getDate()),
                month = w.addZero(d.getMonth() + 1),
                year = d.getFullYear().toString().slice(2, 4);

            return date + '.' + month + '.' + year;
        },

        resetStage(dd, hh, mm, ss) {
            if (dd === 0 && hh === 0 && mm === 0 && ss === 0) {
                w.diffStage = 0;
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        },

        timeUpdate() {
            let days = w.daysInUTC(w.diffStage),
                hours = Math.floor(w.diffStage / 3600),
                mins = Math.floor(w.diffStage / 60),
                secs = Math.floor(w.diffStage),
                dd = days,
                hh = hours - days * 24,
                mm = mins - hours * 60,
                ss = secs - mins * 60;
            w.dd.html(dd);
            w.hh.html(w.addZero(hh));
            w.mm.html(w.addZero(mm));
            w.diffStage -= 1;

            w.resetStage(dd, hh, mm, ss);
        },

        setTimeThreshold() {
            w.startSpan_preSale.text(w.getSmallDate(w.startDate_preSale));
            w.endSpan_preSale.text(w.getSmallDate(w.endDate_preSale));
            w.startSpan_preIco.text(w.getSmallDate(w.startDate_preIco));
            w.endSpan_preIco.text(w.getSmallDate(w.endDate_preIco));
            w.startSpan_ico1.text(w.getSmallDate(w.startDate_ico1));
            w.endSpan_ico1.text(w.getSmallDate(w.endDate_ico1));
            w.startSpan_ico2.text(w.getSmallDate(w.startDate_ico2));
            w.endSpan_ico2.text(w.getSmallDate(w.endDate_ico2));
            w.startSpan_ico3.text(w.getSmallDate(w.startDate_ico3));
            w.endSpan_ico3.text(w.getSmallDate(w.endDate_ico3));
        },

        numberWithSpaces(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },

        setCapTexts() {
            w.currentlyCollectedSpan_ETH.text(parseFloat(w.totalCryptoAmountETH).toFixed(2) + ' ETH ({{ __('_home/widget.currentlyCollected_js') }})');
            w.softCapSpan_ETH.text(w.softCapETH + ' ETH (soft cap) ');
            w.hardCapSpan_ETH.text(w.hardCapETH + ' ETH (hard cap)');
        },

        setSingleCurrencyTexts() {
            let ethCurrentAmount = (Math.round(w.ethCurrentAmount * 100) / 100).toFixed(2);
            let btcCurrentAmount = (Math.round(w.btcCurrentAmount * 100) / 100).toFixed(2);
            w.currencyValue0.text(ethCurrentAmount);
            w.currencyValue1.text(btcCurrentAmount);
        },

        setCapProgressWidth() {
            let percent = Math.ceil((w.totalCryptoAmountETH) * 100 / parseInt(w.hardCapETH));
            w.totalInnerPercents.text(percent + ' %');
            w.totalInnerProgress.css('width', percent + '%');
        },

        logb: function (number, base) {
            return Math.log(number) / Math.log(base);
        }

    };

    $(document).ready(() => {
        w.setCapProgressWidth();
        w.setCapTexts();
        w.setSingleCurrencyTexts();
        w.setTimeThreshold();
        w.setStage();

        setInterval(() => {
            w.timeUpdate();
        }, 1000);

    });
</script>