/**
 * Created by RenatoValer on 24/07/2015.
 */

var AdvApp = angular.module('AdvApp',
    ['ngMaterial'],
    ['angular-oauth2']
);

AdvApp.config(['OAuthProvider', function(OAuthProvider) {
    OAuthProvider.configure({
        baseUrl: 'http://api.rvproject.com',
        clientId: 'CLIENT_ID',
        clientSecret: 'CLIENT_SECRET' // optional
    });
}]);

AdvApp.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        // Redirect to `/login` with the `error_reason`.
        return $window.location.href = '/login?error_reason=' + rejection.data.error;
    });
}]);