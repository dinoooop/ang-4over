app.service('DataService', function ($http, appConfig) {
    this.get_db_data = function (type, callback) {
        $http({
            method: 'GET',
            url: appConfig.url + '/' + type,
        }).then(function successCallback(response) {
            callback(response.data);
        }, function errorCallback(response) {

        });
    }
});


app.service("WebService", function ($http, $q) {
    
    this.postData = function (url, postdata) {

        var deferred = $q.defer();
        var promise = deferred.promise;


        $http.post(url, postdata)
                .then(function (response) {
                    if (response.data['status'] == 'valid') {
                        deferred.resolve(response.data);
                    } else {
                        deferred.reject(response.data);
                    }
                });


        promise.success = function (fn) {
            promise.then(fn);
            return promise;
        }

        promise.error = function (fn) {
            promise.then(null, fn);
            return promise;
        }
        return promise;

    }

    this.getData = function (url, formdata) {

        var deferred = $q.defer();
        var promise = deferred.promise;

        var passdata = {params: formdata};
        
        $http.get(url, passdata)
                .then(function (response) {
                    if (response.data['status'] == 'valid') {
                        deferred.resolve(response.data);
                    } else {
                        deferred.reject(0);
                    }
                });


        promise.success = function (fn) {
            promise.then(fn);
            return promise;
        }

        promise.error = function (fn) {
            promise.then(null, fn);
            return promise;
        }
        return promise;

    }


});