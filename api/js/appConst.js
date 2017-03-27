
var appConst = {};

if (location.host == 'localhost') {
    appConst.apiBase = location.port + '//' + location.host + '/ang-4over/api';
} else {
    appConst.apiBase = location.port + '//' + location.host + '/ang-4over/api';
}


appConst.apiRequest = appConst.apiBase + "/request.php";
appConst.apiMap = appConst.apiBase + "/map.php";
