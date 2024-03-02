class PTCountdownHandler extends elementorModules.frontend.handlers.Base {
  cacheElements() {
    const $countDown = this.$element.find('.pt-countdown');
    this.cache = {
      elements: {
        $days: $countDown.find('.days'),
        $hours: $countDown.find('.hours'),
        $minutes: $countDown.find('.minutes'),
        $seconds: $countDown.find('.seconds')
      },
      data: {
        endTime: new Date($countDown.data('date') * 1000)
      }
    };
  }

  onInit() {
    this.cacheElements();
    this.initializeCountdown();
  }

  initializeCountdown() {
    const self = this;
    this.makeTimer();
    setInterval(function() {
      self.makeTimer();
    }, 1000);
  }

  makeTimer() {
    const timeRemaining = this.cache.data.endTime - new Date();

    let seconds = Math.floor(timeRemaining / 1000 % 60),
        minutes = Math.floor(timeRemaining / 1000 / 60 % 60),
        hours = Math.floor(timeRemaining / (1000 * 60 * 60) % 24),
        days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));

    if (days < 0 || hours < 0 || minutes < 0) {
      seconds = minutes = hours = days = 0;
    }

    jQuery(this.cache.elements.$days).html(this.wrapChars(days));
    jQuery(this.cache.elements.$hours).html(this.wrapChars(hours));
    jQuery(this.cache.elements.$minutes).html(this.wrapChars(minutes));
    jQuery(this.cache.elements.$seconds).html(this.wrapChars(seconds));
  }

  wrapChars(str) {
    str = ('0' + str).slice(-2);
    return str.toString().replace(/\w/g, '<div>$&</div>');
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  elementorFrontend.elementsHandler.attachHandler('pt-countdown', PTCountdownHandler);
});
