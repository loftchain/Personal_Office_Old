<script>
    let w = {
        is_live: $('.square__live'),
        interval: $('.square__interval'),
        counter_title: $('.counter__title'),
        currentDay: $('.current_day'),
        allDay: $('.all_day'),
        i_or_pi: $('.i_pi'),
        day: $('.time__days'),
        hour: $('.time__hour'),
        min: $('.time__min'),
        sec: $('.time__sec'),
        currency0_val: $('.crypto__currency0_val'),
        currency0_name: $('.crypto__currency0_name'),
        currency0_img: $('.crypto__currency0_img'),
        currency1_val: $('.crypto__currency1_val'),
        currency1_name: $('.crypto__currency1_name'),
        currency1_img: $('.crypto__currency1_img'),
        currency2_val: $('.crypto__currency2_val'),
        currency2_name: $('.crypto__currency2_name'),
        currency2_img: $('.crypto__currency2_img'),
        crypto_outer: $('.crypto__outer'),
        crypto_inner: $('.crypto__inner'),
        crypto_arrow_before: $('.crypto_arrow_before'),
        crypto_arrow_after: $('.crypto_arrow_after'),
        crypto_indicator: $('.crypto-progress__indicator'),
        crypto_percentage: 0,

        token_sold: $('.token_sold'),
        token_cap: $('.token_cap'),
        first_sum: $('.first_sum'),
        second_sum: $('.second_sum'),

        pi_start: $('.rounds__pi-start'),
        pi_end: $('.rounds__pi-end'),
        pi_interval: $('.pi-range__interval'),

        i_start: $('.rounds__i-start'),
        i_end: $('.rounds__i-end'),
        i_interval: $('.i-range__interval'),
        i_outer: $('.rounds__outer'),
        i_inner: $('.rounds__inner'),
        i_range: $('.rounds__i-range '),
        round_arrow_before: $('.round_arrow_before'),
        round_arrow_after: $('.round_arrow_after'),
        pi_range: $('.rounds__pi-range '),
        pi_range_indicator: $('.range__shaded_pi'),
        i_range_indicator: $('.range__shaded_i'),
        first_article: $('#squareAndCurrencies'),
        second_article: $('#counterAndRounds'),
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