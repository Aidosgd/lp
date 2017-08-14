(function() {
  var app;

  app = angular.module('app', ['ngAnimate', 'ngCookies', 'ngResource', 'ngSanitize', 'ngTouch', 'ngStorage', 'ui.router', 'ui.bootstrap', 'ui.utils', 'ui.load', 'ui.jq', 'ui.select', 'oc.lazyLoad', 'pascalprecht.translate', 'checklist-model']);

}).call(this);

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

(function() {
  var app;

  app = angular.module('app');

  app.controller('DashboardController', [
    '$scope', function($scope) {
      return $scope.test = 'works';
    }
  ]);

  app.controller('AppCtrl', [
    '$scope', '$translate', '$localStorage', '$window', function($scope, $translate, $localStorage, $window) {
      var isIE, isSmartDevice;
      isSmartDevice = function(window) {
        var ua;
        ua = window['navigator']['userAgent'] || window['navigator']['vendor'] || window['opera'];
        return /iPhone|iPod|iPad|Silk|Android|BlackBerry|Opera Mini|IEMobile/.test(ua);
      };
      isIE = !!navigator.userAgent.match(/MSIE/i);
      isIE && angular.element($window.document.body).addClass('ie');
      isSmartDevice($window) && angular.element($window.document.body).addClass('smart');
      $scope.app = {
        name: 'IBEC CMS',
        version: '5.3',
        color: {
          primary: '#7266ba',
          info: '#23b7e5',
          success: '#27c24c',
          warning: '#fad733',
          danger: '#f05050',
          light: '#e8eff0',
          dark: '#3a3f51',
          black: '#1c2b36'
        },
        settings: {
          themeID: 10,
          navbarHeaderColor: 'bg-info dker',
          navbarCollapseColor: 'bg-info dk',
          asideColor: 'bg-black',
          headerFixed: true,
          asideFixed: false,
          asideFolded: false,
          asideDock: false,
          container: false
        }
      };
      if (angular.isDefined($localStorage.settings)) {
        $scope.app.settings = $localStorage.settings;
      } else {
        $localStorage.settings = $scope.app.settings;
      }
      $scope.$watch('app.settings', (function() {
        if ($scope.app.settings.asideDock && $scope.app.settings.asideFixed) {
          $scope.app.settings.headerFixed = true;
        }
        $localStorage.settings = $scope.app.settings;
      }), true);
      $scope.lang = {
        isopen: false
      };
      $scope.langs = {
        en: 'English',
        ru: 'Rusian'
      };
      $scope.selectLang = $scope.langs[$translate.proposedLanguage()] || 'English';
      return $scope.setLang = function(langKey, $event) {
        $scope.selectLang = $scope.langs[langKey];
        $translate.use(langKey);
        $scope.lang.isopen = !$scope.lang.isopen;
      };
    }
  ]);

  app.controller('RootFormCtrl', [
    '$scope', function($scope) {
      $scope.contentFields = [];
      $scope.addContentField = function() {
        console.log('asd');
        return $scope.contentFields.push({
          name: '',
          type: 'string'
        });
      };
      return $scope.removeContentField = function(index) {
        return $scope.contentFields.splice(index, 1);
      };
    }
  ]);

  app.controller('PostsIndexCtrl', [
    '$scope', '$http', function($scope, $http) {
      $scope.moderationUrl = '';
      $scope.batch = [];
      $scope.approval = {};
      $scope.approve = function(id) {
        var status;
        status = $scope.approval['post_' + id] ? '1' : '2';
        return $http.put($scope.moderationUrl + '/' + id + '?fastModeration=1', {
          'status': status
        });
      };
      return $scope.batchAction = function() {
        return console.log($scope.batch);
      };
    }
  ]);


  /*
  app.service 'Toaster', [
    '$scope', 'toaster', ($scope, toaster) ->
  	$scope.toaster = {
  		type: 'success',
  		title: 'Title',
  		text: 'Message'
  	}
  	$scope.pop = () ->
  		toaster.pop($scope.toaster.type, $scope.toaster.title, $scope.toaster.text)
  ]
   */

  app.controller('MenuTreeCtrl', [
    '$scope', '$http', function($scope, $http) {
      $scope.url = '';
      $scope.storeUrl = '';
      $scope.item = {};
      $scope.additions = {};
      $scope.output = [];
      $scope.providers = {};
      $scope.loadProvider = function(provider, url) {
        return $http.get(url).success(function(data) {
          return $scope.providers[provider] = data;
        });
      };
      $('[ui-jq=nestable]').on('change', function(event) {
        var list;
        list = $(event.target);
        $scope.output = list.nestable('serialize');
        return $scope.$apply();
      });
      $scope.$watch('output', function(val) {
        if (val.length) {
          return $http.put($scope.url, {
            tree: val
          }).success(function(data) {
            return console.log(data);
          });
        }
      });
      return $scope.addItem = function(form) {
        var data;
        data = angular.extend($scope.item, $scope.additions[form]);
        return $http.post($scope.storeUrl, data).success(function(data) {
          var req;
          req = {
            method: 'GET',
            url: window.location.href,
            headers: {
              'Accept': 'text/html',
              'X-Requested-With': 'XMLHttpRequest'
            }
          };
          return $http(req).success(function(data) {
            $scope.item = {};
            return $('[ui-jq=nestable]').html(data);
          });
        });
      };
    }
  ]);

}).call(this);

(function() {
  var _slugify, charmap;

  charmap = {
    ' ': " ",
    '¡': "!",
    '¢': "c",
    '£': "lb",
    '¥': "yen",
    '¦': "|",
    '§': "SS",
    '¨': "\"",
    '©': "(c)",
    'ª': "a",
    '«': "<<",
    '¬': "not",
    '­': "-",
    '®': "(R)",
    '°': "^0",
    '±': "+/-",
    '²': "^2",
    '³': "^3",
    '´': "'",
    'µ': "u",
    '¶': "P",
    '·': ".",
    '¸': ",",
    '¹': "^1",
    'º': "o",
    '»': ">>",
    '¼': " 1/4 ",
    '½': " 1/2 ",
    '¾': " 3/4 ",
    '¿': "?",
    'À': "`A",
    'Á': "'A",
    'Â': "^A",
    'Ã': "~A",
    'Ä': '"A',
    'Å': "A",
    'Æ': "AE",
    'Ç': "C",
    'È': "`E",
    'É': "'E",
    'Ê': "^E",
    'Ë': '"E',
    'Ì': "`I",
    'Í': "'I",
    'Î': "^I",
    'Ï': '"I',
    'Ð': "D",
    'Ñ': "~N",
    'Ò': "`O",
    'Ó': "'O",
    'Ô': "^O",
    'Õ': "~O",
    'Ö': '"O',
    '×': "x",
    'Ø': "O",
    'Ù': "`U",
    'Ú': "'U",
    'Û': "^U",
    'Ü': '"U',
    'Ý': "'Y",
    'Þ': "Th",
    'ß': "ss",
    'à': "`a",
    'á': "'a",
    'â': "^a",
    'ã': "~a",
    'ä': '"a',
    'å': "a",
    'æ': "ae",
    'ç': "c",
    'è': "`e",
    'é': "'e",
    'ê': "^e",
    'ë': '"e',
    'ì': "`i",
    'í': "'i",
    'î': "^i",
    'ï': '"i',
    'ð': "d",
    'ñ': "~n",
    'ò': "`o",
    'ó': "'o",
    'ô': "^o",
    'õ': "~o",
    'ö': '"o',
    '÷': ":",
    'ø': "o",
    'ù': "`u",
    'ú': "'u",
    'û': "^u",
    'ü': '"u',
    'ý': "'y",
    'þ': "th",
    'ÿ': '"y',
    'Ā': "A",
    'ā': "a",
    'Ă': "A",
    'ă': "a",
    'Ą': "A",
    'ą': "a",
    'Ć': "'C",
    'ć': "'c",
    'Ĉ': "^C",
    'ĉ': "^c",
    'Ċ': "C",
    'ċ': "c",
    'Č': "C",
    'č': "c",
    'Ď': "D",
    'ď': "d",
    'Đ': "D",
    'đ': "d",
    'Ē': "E",
    'ē': "e",
    'Ĕ': "E",
    'ĕ': "e",
    'Ė': "E",
    'ė': "e",
    'Ę': "E",
    'ę': "e",
    'Ě': "E",
    'ě': "e",
    'Ĝ': "^G",
    'ĝ': "^g",
    'Ğ': "G",
    'ğ': "g",
    'Ġ': "G",
    'ġ': "g",
    'Ģ': "G",
    'ģ': "g",
    'Ĥ': "^H",
    'ĥ': "^h",
    'Ħ': "H",
    'ħ': "h",
    'Ĩ': "~I",
    'ĩ': "~i",
    'Ī': "I",
    'ī': "i",
    'Ĭ': "I",
    'ĭ': "i",
    'Į': "I",
    'į': "i",
    'İ': "I",
    'ı': "i",
    'Ĳ': "IJ",
    'ĳ': "ij",
    'Ĵ': "^J",
    'ĵ': "^j",
    'Ķ': "K",
    'ķ': "k",
    'Ĺ': "L",
    'ĺ': "l",
    'Ļ': "L",
    'ļ': "l",
    'Ľ': "L",
    'ľ': "l",
    'Ŀ': "L",
    'ŀ': "l",
    'Ł': "L",
    'ł': "l",
    'Ń': "'N",
    'ń': "'n",
    'Ņ': "N",
    'ņ': "n",
    'Ň': "N",
    'ň': "n",
    'ŉ': "'n",
    'Ō': "O",
    'ō': "o",
    'Ŏ': "O",
    'ŏ': "o",
    'Ő': '"O',
    'ő': '"o',
    'Œ': "OE",
    'œ': "oe",
    'Ŕ': "'R",
    'ŕ': "'r",
    'Ŗ': "R",
    'ŗ': "r",
    'Ř': "R",
    'ř': "r",
    'Ś': "'S",
    'ś': "'s",
    'Ŝ': "^S",
    'ŝ': "^s",
    'Ş': "S",
    'ş': "s",
    'Š': "S",
    'š': "s",
    'Ţ': "T",
    'ţ': "t",
    'Ť': "T",
    'ť': "t",
    'Ŧ': "T",
    'ŧ': "t",
    'Ũ': "~U",
    'ũ': "~u",
    'Ū': "U",
    'ū': "u",
    'Ŭ': "U",
    'ŭ': "u",
    'Ů': "U",
    'ů': "u",
    'Ű': '"U',
    'ű': '"u',
    'Ų': "U",
    'ų': "u",
    'Ŵ': "^W",
    'ŵ': "^w",
    'Ŷ': "^Y",
    'ŷ': "^y",
    'Ÿ': '"Y',
    'Ź': "'Z",
    'ź': "'z",
    'Ż': "Z",
    'ż': "z",
    'Ž': "Z",
    'ž': "z",
    'ſ': "s"
  };

  _slugify = function(s) {
    var ascii, ch, cp, i, j, ref;
    if (!s) {
      return "";
    }
    ascii = [];
    for (i = j = 0, ref = s.length; 0 <= ref ? j <= ref : j >= ref; i = 0 <= ref ? ++j : --j) {
      if ((cp = s.charCodeAt(i)) < 0x180) {
        ch = String.fromCharCode(cp);
        ascii.push(charmap[ch] || ch);
      }
    }
    s = ascii.join("");
    s = s.replace(/[^\w\s-]/g, "").trim().toLowerCase();
    return s.replace(/[-\s]+/g, "-");
  };

  jQuery.slugify = function(str) {
    return _slugify(str);
  };

}).call(this);

//# sourceMappingURL=app.js.map
