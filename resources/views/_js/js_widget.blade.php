<script>
    let w = {
        preIcoStart: '{{ env('PRE_ICO_START') }}',
        preIcoEnd: '{{ env('PRE_ICO_END') }}',
        icoStart: '{{ env('ICO_START') }}',
        icoEnd: '{{ env('ICO_END') }}',
        currentStage: '{{ $data['period'][0] }}',
        nextStage: '{{ $data['period'][1] }}',
        _now: ('{{ $data['time'] }}') ? '{{ $data['time'] }}' : Math.floor(new Date().getTime() / 1000),
        ethSoftCap: ('{{ $data['ethSoftCap']['currency'] }}'),
        ethSoftCapUsd: ('{{ $data['ethSoftCap']['usd'] }}'),
        ethSoftCapToken: ('{{ $data['ethSoftCap']['token'] }}'),
        btcSoftCap: ('{{ $data['btcSoftCap']['currency'] }}'),
        btcSoftCapUsd: ('{{ $data['btcSoftCap']['usd'] }}'),
        btcSoftCapToken: ('{{ $data['btcSoftCap']['token'] }}'),
        wholeSoftCapUsd: ('{{ $data['wholeSoftCap'][1] }}'),
        wholeSoftCapToken: ('{{ $data['wholeSoftCap'][2] }}'),
        currentStageTitle: $('.js__stage-name-title'),
        preStageTitle: $('.js__stage-pre'),
        icoStageTitle: $('.js__stage-ico'),
        preStartDate: $('.dates__start_pre'),
        preEndDate: $('.dates__end_pre'),
        icoStartDate: $('.dates__start_ico'),
        icoEndDate: $('.dates__end_ico'),
        preInnerProgress: $('.x-progress__in_pre'),
        icoInnerProgress: $('.x-progress__in_ico'),
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
                case w.currentStage === 'pre_ico':
                    w.currentStageTitle.text('До конца pre-ICO');
                    w.diffStage = w.preIcoEnd - w._now;
                    w.setInnerWidth('pre_ico');
                    break;
                case w.currentStage === 'ico':
                    w.currentStageTitle.text('До конца ICO');
                    w.diffStage = w.icoEnd - w._now;
                    w.setInnerWidth('ico');
                    break;
                case w.nextStage === 'pre_ico':
                    w.currentStageTitle.text('До начала pre-ICO');
                    w.diffStage = w.preIcoStart - w._now;
                    w.setInnerWidth('pre_ico_next');
                    break;
                case w.nextStage === 'ico':
                    w.currentStageTitle.text('До начала ICO');
                    w.diffStage = w.icoStart - w._now;
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
            w.preStartDate.text(w.getSmallDate(w.preIcoStart));
            w.preEndDate.text(w.getSmallDate(w.preIcoEnd));
            w.icoStartDate.text(w.getSmallDate(w.icoStart));
            w.icoEndDate.text(w.getSmallDate(w.icoEnd));
        },

        setInnerWidth(stage) {
            switch (stage) {
                case 'pre_ico':
                    w.preInnerProgress.css('width', 'calc(' + w.calcInnerWidth(w.preIcoStart, w.preIcoEnd) + '% + 4px)');
                    w.icoInnerProgress.css('width', '0');
                    break;
                case 'ico':
                    w.preInnerProgress.css('width', 'calc(100% + 4px)');
                    w.icoInnerProgress.css('width', 'calc(' + w.calcInnerWidth(w.preIcoStart, w.preIcoEnd) + '% + 4px)');
                    break;
                case 'pre_ico_next':
                    w.preInnerProgress.css('width', '0');
                    w.icoInnerProgress.css('width', '0');
                    break;
                case 'ico_next':
                    w.preInnerProgress.css('width', '100%');
                    w.icoInnerProgress.css('width', '0');
                    break;
                case 'finish':
                    w.preInnerProgress.css('width', '100%');
                    w.icoInnerProgress.css('width', '100%');
                    break;
            }
        },

        calcInnerWidth(start, end) {
            let wholePeriodInDays = Math.floor(w.daysInUTC(end - start));
            let currentPeriodInDays = Math.floor(w.daysInUTC(w._now - start));
            return Math.floor(currentPeriodInDays * 100 / wholePeriodInDays);
        },

        setCapTexts() {
          w.capCryptoStart.text(w.wholeSoftCapToken);
          w.capCryptoEnd.text('{{ env('TOKEN_CAP') }}');
          w.capFiatStart.text(w.wholeSoftCapUsd);
          w.capFiatEnd.text('{{ env('USD_CAP') }}');
        },

        logb: function (number, base) {
            return Math.log(number) / Math.log(base);
        }
    };

    $(document).ready(() => {
        w.setCapTexts();
        w.setTimeThreshold();
        w.setStage();

        setInterval(() => {
            w.timeUpdate();
        }, 1000);

    });
</script>