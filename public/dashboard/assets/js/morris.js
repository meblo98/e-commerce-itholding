
!function($) {
  "use strict";

  var MorrisCharts = function() {};

  MorrisCharts.prototype.createDonutChart = function(element, data, colors) {
    Morris.Donut({
      element: element,
      data: data,
      resize: true,
      colors: colors,
      formatter : function (y, data) {
        return y
      }
    });
  },

  MorrisCharts.prototype.init = function() {
    var el = document.getElementById('morris-donut-1');
    if (!el) return;

    var $donutData = [];
    var attr = el.getAttribute('data-donut');
    if (attr) {
      try {
        var parsed = JSON.parse(attr);
        if (Array.isArray(parsed)) {
          $donutData = parsed;
        }
      } catch (e) {
        // ignore and use fallback
      }
    }

    if ($donutData.length === 0) {
      $donutData = [
        {label: "Catégorie A", value: 12},
        {label: "Catégorie B", value: 30},
        {label: "Catégorie C", value: 20},
        {label: "Catégorie D", value: 20},
        {label: "Catégorie E", value: 20},
        {label: "Catégorie F", value: 20},
      ];
    }

    this.createDonutChart('morris-donut-1', $donutData, ['#22C55E', '#2377FC', '#8F77F3', '#FFBA93', '#FFE99A', '#B0E7FF']);
  },

  $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

function($) {
  "use strict";
  $.MorrisCharts.init();
}(window.jQuery);
