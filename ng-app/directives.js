app.directive('sampleDer', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
        scope: {
            anyData: '@'
        },
        link: function (scope, element, attr) {


        },
    }
});