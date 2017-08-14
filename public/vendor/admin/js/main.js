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
        name: 'CMS',
        version: '0.1.0',
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
          themeID: 1,
          navbarHeaderColor: 'bg-black',
          navbarCollapseColor: 'bg-white-only',
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

//# sourceMappingURL=main.js.map