class PTAccordionHandler extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        accordion: '.pt-accordion'
      }
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');

    return {
      $accordionContainer: this.$element.find(selectors.accordion)
    }
  }

  onInit() {
    const elements = this.getDefaultElements();

    jQuery(elements.$accordionContainer.get(0)).accordion({
      animate: 300,
      collapsible: true,
      icons: '',
      heightStyle: 'content'
    });
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  elementorFrontend.elementsHandler.attachHandler('pt-accordion', PTAccordionHandler);
});
