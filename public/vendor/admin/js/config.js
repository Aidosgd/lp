(function() {
  var app;

  app = angular.module('app').config([
    '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', function($controllerProvider, $compileProvider, $filterProvider, $provide) {
      app.controller = $controllerProvider.register;
      app.directive = $compileProvider.directive;
      app.filter = $filterProvider.register;
      app.factory = $provide.factory;
      app.service = $provide.service;
      app.constant = $provide.constant;
      return app.value = $provide.value;
    }
  ]).config([
    '$translateProvider', function($translateProvider) {
      $translateProvider.useStaticFilesLoader({
        prefix: 'l10n/',
        suffix: '.js'
      });
      $translateProvider.preferredLanguage('en');
      return $translateProvider.useLocalStorage();
    }
  ]).constant('JQ_CONFIG', {
    easyPieChart: ['/vendor/admin/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.fill.js'],
    sparkline: ['/vendor/admin/bower_components/jquery.sparkline/dist/jquery.sparkline.retina.js'],
    plot: ['/vendor/admin/bower_components/flot/jquery.flot.js', '/vendor/admin/bower_components/flot/jquery.flot.pie.js', '/vendor/admin/bower_components/flot/jquery.flot.resize.js', '/vendor/admin/bower_components/flot.tooltip/js/jquery.flot.tooltip.js', '/vendor/admin/bower_components/flot.orderbars/js/jquery.flot.orderBars.js', '/vendor/admin/bower_components/flot-spline/js/jquery.flot.spline.js'],
    moment: ['/vendor/admin/bower_components/moment/moment.js'],
    screenfull: ['/vendor/admin/bower_components/screenfull/dist/screenfull.min.js'],
    slimScroll: ['/vendor/admin/bower_components/slimscroll/jquery.slimscroll.min.js'],
    sortable: ['/vendor/admin/bower_components/html5sortable/jquery.sortable.js'],
    nestable: ['/vendor/admin/bower_components/nestable/jquery.nestable.js', '/vendor/admin/bower_components/nestable/jquery.nestable.css'],
    filestyle: ['/vendor/admin/bower_components/bootstrap-filestyle/src/bootstrap-filestyle.js'],
    slider: ['/vendor/admin/bower_components/bootstrap-slider/bootstrap-slider.js', '/vendor/admin/bower_components/bootstrap-slider/bootstrap-slider.css'],
    chosen: ['/vendor/admin/bower_components/chosen/chosen.jquery.min.js', '/vendor/admin/bower_components/bootstrap-chosen/bootstrap-chosen.css'],
    TouchSpin: ['/vendor/admin/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js', '/vendor/admin/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'],
    wysiwyg: ['/vendor/admin/bower_components/bootstrap-wysiwyg/bootstrap-wysiwyg.js', '/vendor/admin/bower_components/bootstrap-wysiwyg/external/jquery.hotkeys.js'],
    ckeditor: ['/vendor/admin/bower_components/ckeditor/ckeditor.js', '/vendor/admin/bower_components/ckeditor/adapters/jquery.js'],
    dataTable: ['/vendor/admin/bower_components/datatables/media/js/jquery.dataTables.min.js', '/vendor/admin/bower_components/plugins/integration/bootstrap/3/dataTables.bootstrap.js', '/vendor/admin/bower_components/plugins/integration/bootstrap/3/dataTables.bootstrap.css'],
    vectorMap: ['/vendor/admin/bower_components/bower-jvectormap/jquery-jvectormap-1.2.2.min.js', '/vendor/admin/bower_components/bower-jvectormap/jquery-jvectormap-world-mill-en.js', '/vendor/admin/bower_components/bower-jvectormap/jquery-jvectormap-us-aea-en.js', '/vendor/admin/bower_components/bower-jvectormap/jquery-jvectormap-1.2.2.css'],
    footable: ['/vendor/admin/bower_components/footable/dist/footable.all.min.js', '/vendor/admin/bower_components/footable/css/footable.core.css'],
    fullcalendar: ['/vendor/admin/bower_components/moment/moment.js', '/vendor/admin/bower_components/fullcalendar/dist/fullcalendar.min.js', '/vendor/admin/bower_components/fullcalendar/dist/fullcalendar.css', '/vendor/admin/bower_components/fullcalendar/dist/fullcalendar.theme.css'],
    daterangepicker: ['/vendor/admin/bower_components/moment/moment.js', '/vendor/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js', '/vendor/admin/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css'],
    datetimepicker: ['/vendor/admin/bower_components/moment/moment.js', '/vendor/admin/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js', '/vendor/admin/bower_components/eonasdan-bootstrap-datetimepicker/src/bootstrap-datetimepicker.css'],
    tagsinput: ['/vendor/admin/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js', '/vendor/admin/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'],
    selectpicker: ['/vendor/admin/bower_components/bootstrap-select/dist/js/bootstrap-select.js', '/vendor/admin/bower_components/bootstrap-select/dist/css/bootstrap-select.css'],
    mask: ['/vendor/admin/bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js']
  }).config([
    '$ocLazyLoadProvider', function($ocLazyLoadProvider) {
      return $ocLazyLoadProvider.config({
        debug: true,
        events: true,
        modules: [
          {
            name: 'ngGrid',
            files: ['/vendor/admin/bower_components/ng-grid/build/ng-grid.min.js', '/vendor/admin/bower_components/ng-grid/ng-grid.min.css', '/vendor/admin/bower_components/ng-grid/ng-grid.bootstrap.css']
          }, {
            name: 'ui.grid',
            files: ['/vendor/admin/bower_components/angular-ui-grid/ui-grid.min.js', '/vendor/admin/bower_components/angular-ui-grid/ui-grid.min.css', '/vendor/admin/bower_components/angular-ui-grid/ui-grid.bootstrap.css']
          }, {
            name: 'ui.tree',
            files: ['/vendor/admin/bower_components/angular-ui-tree/dist/anguler-ui-tree.min.js', '/vendor/admin/bower_components/angular-ui-tree/dist/anguler-ui-tree.min.css']
          }, {
            name: 'ui.select',
            files: ['/vendor/admin/bower_components/angular-ui-select/dist/select.min.js', '/vendor/admin/bower_components/angular-ui-select/dist/select.min.css']
          }, {
            name: 'angularFileUpload',
            files: ['/vendor/admin/bower_components/angular-file-upload/angular-file-upload.min.js']
          }, {
            name: 'ui.calendar',
            files: ['/vendor/admin/bower_components/angular-ui-calendar/src/calendar.js']
          }, {
            name: 'ngImgCrop',
            files: ['/vendor/admin/bower_components/ngImgCrop/compile/minified/ng-img-crop.js', '/vendor/admin/bower_components/ngImgCrop/compile/minified/ng-img-crop.css']
          }, {
            name: 'angularBootstrapNavTree',
            files: ['/vendor/admin/bower_components/angular-bootstrap-nav-tree/dist/abn_tree_directive.js', '/vendor/admin/bower_components/angular-bootstrap-nav-tree/dist/abn_tree.css']
          }, {
            name: 'toaster',
            files: ['/vendor/admin/bower_components/angularjs-toaster/toaster.js', '/vendor/admin/bower_components/angularjs-toaster/toaster.css']
          }, {
            name: 'textAngular',
            files: ['/vendor/admin/bower_components/textAngular/dist/textAngular-sanitize.min.js', '/vendor/admin/bower_components/textAngular/dist/textAngular.min.js']
          }, {
            name: 'vr.directives.slider',
            files: ['/vendor/admin/bower_components/venturocket-angular-slider/build/angular-slider.min.js', '/vendor/admin/bower_components/venturocket-angular-slider/build/angular-slider.css']
          }, {
            name: 'com.2fdevs.videogular',
            files: ['/vendor/admin/bower_components/videogular/videogular.min.js']
          }, {
            name: 'com.2fdevs.videogular.plugins.controls',
            files: ['/vendor/admin/bower_components/videogular-controls/controls.min.js']
          }, {
            name: 'com.2fdevs.videogular.plugins.buffering',
            files: ['/vendor/admin/bower_components/videogular-buffering/buffering.min.js']
          }, {
            name: 'com.2fdevs.videogular.plugins.overlayplay',
            files: ['/vendor/admin/bower_components/videogular-overlay-play/overlay-play.min.js']
          }, {
            name: 'com.2fdevs.videogular.plugins.poster',
            files: ['/vendor/admin/bower_components/videogular-poster/poster.min.js']
          }, {
            name: 'com.2fdevs.videogular.plugins.imaads',
            files: ['/vendor/admin/bower_components/videogular-ima-ads/ima-ads.min.js']
          }, {
            name: 'xeditable',
            files: ['/vendor/admin/bower_components/angular-xeditable/dist/js/xeditable.min.js', '/vendor/admin/bower_components/angular-xeditable/dist/css/xeditable.css']
          }, {
            name: 'smart-table',
            files: ['/vendor/admin/bower_components/angular-smart-table/dist/smart-table.min.js']
          }
        ]
      });
    }
  ]);

}).call(this);

//# sourceMappingURL=config.js.map