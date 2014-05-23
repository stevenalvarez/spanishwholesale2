/* http://keith-wood.name/countdown.html
 * Spanish initialisation for the jQuery countdown extension
 * Written by Sergio Carracedo Martinez webmaster@neodisenoweb.com (2008) */
(function($) {
	$.countdown.regional['es'] = {
		labels: ['Años', 'Meses', 'Semanas', 'Días', 'Horas', 'Min.', 'Seg.'],
		labels1: ['Año', 'Mes', 'Semana', 'Día', 'Hora', 'Min.', 'Seg.'],
		compactLabels: ['a', 'm', 's', 'g'],
		whichLabels: null,
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['es']);
})(jQuery);
