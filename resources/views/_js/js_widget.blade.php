<script>
    let w = {
        preSaleStart: '{{ env('PRE_SALE_START') }}',
        preSaleEnd: '{{ env('PRE_SALE_END') }}',

        preIcoStart: '{{ env('PRE_ICO_START') }}',
        preIcoEnd: '{{ env('PRE_ICO_END') }}',

        ico1Start: '{{ env('ICO1_START') }}',
        ico1End: '{{ env('ICO1_END') }}',

        ico2Start: '{{ env('ICO2_START') }}',
        ico2End: '{{ env('ICO2_END') }}',

        ico3Start: '{{ env('ICO3_START') }}',
        ico3End: '{{ env('ICO3_END') }}',

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
        preSaleStartDate: $('.dates__start_pre-sale'),
        preSaleEndDate: $('.dates__end_pre-sale'),
        preIcoStartDate: $('.dates__start_pre-ico'),
        preIcoEndDate: $('.dates__end_pre-ico'),
        preSaleInnerProgress: $('.x-progress__in_pre-sale'),
        preIcoInnerProgress: $('.x-progress__in_pre-ico'),

        dd: $('.js__dd'),
        hh: $('.js__hh'),
        mm: $('.js__mm'),
        ddName: $('.js__dd-name'),
        hhName: $('.js__hh-name'),
        mmName: $('.js__mm-name'),
        capCryptoStart: $('.js_caps__start_crypto'),
        capCryptoEnd: $('.js_caps__end_crypto'),
        capFiatStart: $('.js_caps__start_fiat'),
        capFiatEnd: $('.js_caps__end_fiat'),
        totalInnerProgress: $('.x-progress__in'),
        totalInnerPercents: $('.x-progress__percents'),
        currencyValue0: $('.a0'),
        currencyName0: $('.n0'),
        currencyValue1: $('.a1'),
        currencyName1: $('.n1'),

        setStage() {
            switch (true) {
                case w.currentStage === 'pre_sale':
                    w.currentStageTitle.text('До конца pre-ICO');
                    w.diffStage = w.preSaleEnd - w._now;
                    w.setInnerWidth('pre_ico');
                    break;
                case w.currentStage === 'pre_ico':
                    w.currentStageTitle.text('До конца pre-ICO');
                    w.diffStage = w.preIcoEnd - w._now;
                    w.setInnerWidth('pre_ico');
                    break;
                case w.currentStage === 'ico1':
                    w.currentStageTitle.text('До конца pre-ICO');
                    w.diffStage = w.ico1End - w._now;
                    w.setInnerWidth('pre_ico');
                    break;
                case w.currentStage === 'ico2':
                    w.currentStageTitle.text('До конца pre-ICO');
                    w.diffStage = w.ico2End - w._now;
                    w.setInnerWidth('pre_ico');
                    break;
                case w.currentStage === 'ico3':
                    w.currentStageTitle.text('До конца ICO');
                    w.diffStage = w.ico3End - w._now;
                    w.setInnerWidth('ico');
                    break;
 //------------------------------------------------------------------------------
                case w.nextStage === 'pre_sale':
                    w.currentStageTitle.text('До начала Pre-Sale');
                    w.diffStage = w.preSaleStart - w._now;
                    w.setInnerWidth('pre_ico_next');
                    break;
                case w.nextStage === 'pre_ico':
                    w.currentStageTitle.text('До начала Pre-ICO');
                    w.diffStage = w.preIcoStart - w._now;
                    w.setInnerWidth('pre_ico_next');
                    break;
                case w.nextStage === 'ico1':
                    w.currentStageTitle.text('До начала ICO');
                    w.diffStage = w.ico1Start - w._now;
                    w.setInnerWidth('ico_next');
                    break;
                case w.nextStage === 'ico2':
                    w.currentStageTitle.text('До начала ICO');
                    w.diffStage = w.ico2Start - w._now;
                    w.setInnerWidth('ico_next');
                    break;
                case w.nextStage === 'ico3':
                    w.currentStageTitle.text('До начала ICO');
                    w.diffStage = w.ico3Start - w._now;
                    w.setInnerWidth('ico_next');
                    break;
                case w.currentStage === 'finish':
                    w.diffStage = 0;
                    w.setInnerWidth('finish');
                    w.currentStageTitle.text('Распродажа закончена');
                    break;
            }
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
            w.preSaleStartDate.text(w.getSmallDate(w.preIcoStart));
            w.preSaleEndDate.text(w.getSmallDate(w.preIcoEnd));
            w.preIcoStartDate.text(w.getSmallDate(w.icoStart));
            w.preIcoEndDate.text(w.getSmallDate(w.icoEnd));
        },

        setInnerWidth(stage) {
            switch (stage) {
                case 'pre_ico':
                    w.preSaleInnerProgress.css('width', 'calc(' + w.calcInnerWidth(w.preIcoStart, w.preIcoEnd) + '% + 4px)');
                    w.preIcoInnerProgress.css('width', '0');
                    break;
                case 'ico':
                    w.preSaleInnerProgress.css('width', 'calc(100% + 4px)');
                    w.preIcoInnerProgress.css('width', 'calc(' + w.calcInnerWidth(w.preIcoStart, w.preIcoEnd) + '% + 4px)');
                    break;
                case 'pre_ico_next':
                    w.preSaleInnerProgress.css('width', '0');
                    w.preIcoInnerProgress.css('width', '0');
                    break;
                case 'ico_next':
                    w.preSaleInnerProgress.css('width', 'calc(100% + 4px)');
                    w.preIcoInnerProgress.css('width', '0');
                    break;
                case 'finish':
                    w.preSaleInnerProgress.css('width', 'calc(100% + 4px)');
                    w.preIcoInnerProgress.css('width', 'calc(100% + 4px)');
                    break;
            }
        },

        calcInnerWidth(start, end) {
            let wholePeriodInDays = Math.floor(w.daysInUTC(end - start));
            let currentPeriodInDays = Math.floor(w.daysInUTC(w._now - start));
            return Math.floor(currentPeriodInDays * 100 / wholePeriodInDays);
        },
        numberWithSpaces(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },
        setCapTexts() {
            let tokenCap = Math.floor(w.totalCryptoAmountToken);
            let usdCap = Math.floor(w.totalCryptoAmountETH);
            w.capCryptoStart.text(w.numberWithSpaces(tokenCap) + ' ' + w.tokenName);
            w.capCryptoEnd.text(w.numberWithSpaces(parseInt(w.tokenHardCap)) + ' ' + w.tokenName);
            w.capFiatStart.text(w.numberWithSpaces(usdCap) + ' ETH');
            w.capFiatEnd.text(w.numberWithSpaces(parseInt(w.usdHardCap)) + ' ETH');
        },

        setSingleCurrencyTexts() {
            let ethCurrentAmount = (Math.round(w.ethCurrentAmount * 100) / 100).toFixed(2);
            let btcCurrentAmount = (Math.round(w.btcCurrentAmount * 100) / 100).toFixed(2);
            w.currencyValue0.text(ethCurrentAmount);
            w.currencyValue1.text(btcCurrentAmount);
        },
        setCapProgressWidth() {
            let percent = Math.ceil((w.totalCryptoAmountETH) * 100 / parseInt(w.usdHardCap));
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