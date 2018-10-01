<script>
    let w = {
        timerDaysCountEl: $('.js__dd'),
        timerHoursCountEl: $('.js__hh'),
        timerMinutesCountEl: $('.js__mm'),
        
        timerInterval: undefined,
        timerTickMs: 1000,
        timerBegin: new Date({{ $data['timerBegin'] * 1000 }}),
        timerCurrent: new Date({{ $data['timerCurrent'] * 1000 }}),
        timerEnd: new Date({{ $data['timerEnd'] * 1000 }}),
        timerProgressBarEl: $('.x-progress__in_ico'),

        addZero: function(num) {
            return num > 9 ? num : '0' + num;
        },

        timerTick: function() {
            let timeDiff = this.timerEnd - this.timerCurrent;
            
            let days = Math.floor(timeDiff / 86400000);
            let hours = Math.floor((timeDiff - days * 86400000) / 3600000);
            let minutes = Math.floor((timeDiff - days * 86400000 - hours * 3600000) / 60000);
            
            this.timerDaysCountEl.html(this.addZero(days));
            this.timerHoursCountEl.html(this.addZero(hours));
            this.timerMinutesCountEl.html(this.addZero(minutes));

            if (timeDiff <= 0) {
                clearInterval(this.timerInterval);
                timeDiff = 0;
                // location.reload();
            }
        },
        
        timerProgressBarUpdate: function() {
            this.timerProgressBarEl.css('width', 100 - Math.floor((this.timerEnd - this.timerCurrent) / ((this.timerEnd - this.timerBegin) * 0.01)) + '%');
        }
    };

    $(document).ready(() => {
        if (w.timerEnd > 0) {
            w.timerInterval = setInterval(() => {
                w.timerCurrent.setMilliseconds(w.timerCurrent.getMilliseconds() + 1000);
                w.timerTick();
                
                if (w.timerBegin > 0) {
                    w.timerProgressBarUpdate();
                }
            }, w.timerTickMs);
        }
    });
</script>