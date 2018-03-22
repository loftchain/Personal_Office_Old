<script>
    let w = {
        currentStageTitle: $('.js__round-name-title'),
        preStageTitle: $('.js__round-pre'),
        icoStageTitle: $('.js__round-ico'),
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
        totalInnerProgress: $('.x-progress__in'),
        totalInnerPercents: $('.x-progress__percents'),
        currencyValue0: $('.a0'),
        currencyName0: $('.n0'),
        currencyValue1: $('.a1'),
        currencyName1: $('.n1'),



        getSmallDate: (param) => {
            let o = new Date(parseInt(param, 10)).getTimezoneOffset();
            let d = new Date(parseInt(param, 10) + o * 60000);
            return monthNames[d.getMonth()] + ' ' + d.getDate();
        },
        logb: function (number, base) {
            return Math.log(number) / Math.log(base);
        }
    };

    let monthNames = [
        Jan, Feb, Mar, Apr, May, June, July, Aug, Sept, Oct, Nov, Dec
    ];

    let diff;
    $.fn.widthPerc = function () {
        let parent = this.parent();
        return ~~((this.width() / parent.width()) * 100) + "%";
    };

    function pad(num) {
        return num > 9 ? num : '0' + num;
    }

    function daysInUTC(utc) {
        return Math.floor(utc / (1000 * 60 * 60 * 24))
    }

    function updateWidgetTime() {

        let days = daysInUTC(diff),
            hours = Math.floor(diff / (1000 * 60 * 60)),
            mins = Math.floor(diff / (1000 * 60)),
            secs = Math.floor(diff / 1000),
            dd = days,
            hh = hours - days * 24,
            mm = mins - hours * 60,
            ss = secs - mins * 60,
            translated_day = '';

        switch (dd) {
            case 0 :
                translated_day = day_0;
                break;
            case 1 :
                translated_day = day_1;
                break;
            case 2 :
            case 3 :
            case 4 :
                translated_day = day_234;
            default :
                translated_day = day_default;
                break
        }

        w.day.html(dd);
        w.hour.html(pad(hh));
        w.min.html(pad(mm));
        w.sec.html(pad(ss));
        diff -= 1000;

        if (dd === 0 && hh === 0 && mm === 0 && ss === 0) {
            diff = 0;
            setTimeout(function () {
                location.reload();
            }, 2000);
        }
    }
</script>