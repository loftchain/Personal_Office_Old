<script>
    let w = {
    	currentStage: '{{ $data['period'][0] }}',
    	nextStage: '{{ $data['period'][1] }}',
    	diffStage: '{{ $data['period'][2] }}',
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
        totalInnerProgress: $('.x-progress__in'),
        totalInnerPercents: $('.x-progress__percents'),
        currencyValue0: $('.a0'),
        currencyName0: $('.n0'),
        currencyValue1: $('.a1'),
        currencyName1: $('.n1'),

        setStageTitle: () => {
    		switch (true){
			    case w.currentStage === 'pre-ico':
				    w.currentStageTitle.text('До конца pre-ICO');
				    break;
			    case w.currentStage === 'ico':
				    w.currentStageTitle.text('До конца ICO');
				    break;
                case w.nextStage === 'pre-ico':
	                w.currentStageTitle.text('До начала pre-ICO');
	                break;
			    case w.nextStage === 'ico':
				    w.currentStageTitle.text('До начала ICO');
				    break;
			    case w.nextStage === 'finish':
				    w.currentStageTitle.text('Распродажа закончена');
				    break;
            }
        },

        timeUpdate: () => {
	        let days = daysInUTC(w.diffStage),
		        hours = Math.floor(w.diffStage / (1000 * 60 * 60)),
		        mins = Math.floor(w.diffStage / (1000 * 60)),
		        secs = Math.floor(w.diffStage / 1000),
		        dd = days,
		        hh = hours - days * 24,
		        mm = mins - hours * 60,
		        ss = secs - mins * 60;

	        w.dd.html(dd);
	        w.hh.html(pad(hh));
	        w.mm.html(pad(mm));
	        console.log(ss);
	        w.diffStage -= 1000;

	        if (dd === 0 && hh === 0 && mm === 0 && ss === 0) {
		        diff = 0;
		        setTimeout(function () {
			        location.reload();
		        }, 2000);
	        }
        },

        logb: function (number, base) {
            return Math.log(number) / Math.log(base);
        }
    };

    // let monthNames = [
    //     Jan, Feb, Mar, Apr, May, June, July, Aug, Sept, Oct, Nov, Dec
    // ];

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

    $(document).ready(() =>{
    	w.setStageTitle();
    	setInterval(() => {w.timeUpdate();},1000);

    });
</script>