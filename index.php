<!DOCTYPE HTML>
<html ng-app="api4over">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <!--<script src="js/jquery-1.11.1.min.js"></script>-->
        <script type="text/javascript" src="api/js/appConst.js"></script>

        <!-- Angular JS -->
        <script src="ng-app/angular.min.js"></script>
        <script src="ng-app/prototype.js"></script>
        <script src="ng-app/app.js"></script>
        <script src="ng-app/appEnv.js"></script>
        <script src="ng-app/constants.js"></script>
        <script src="ng-app/controllers.js"></script>
        <script src="ng-app/directives.js"></script>
        <script src="ng-app/filters.js"></script>
        <script src="ng-app/services.js"></script>

        <!-- Plugins -->
        <script src="plugins/datepicker/angular-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="plugins/datepicker/angular-datepicker.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">

        <title>4Over</title>
    </head>
    <body>

        <div class="container"  ng-controller="mainFormController">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Print Specification</h3>

                    <form name="job"  ng-submit="onSubmitForm()" novalidate>

                        <div class="form-group" ng-class="{'has-error' : job.jobName.$invalid && job.jobName.$touched}">
                            <label for="job_name">Job Name</label>
                            <input type="text" class="form-control" name="jobName" ng-model="jobName" required>
                            <p ng-show="job.jobName.$invalid && job.jobName.$touched" class="help-block">Job name required.</p>
                        </div>



                        <div class="form-group">
                            <label for="coating">Coating</label>
                            <select name="coating" class="form-control" id="coating"  ng-model="coating" ng-change="onChangeCoating()">
                                <option value="{{x.key}}" ng-repeat="x in dataCoating">{{x.value}}</option>
                            </select>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error' : job.size.$invalid && job.size.$touched}">
                            <label for="size">Size</label>
                            <select name="size" class="form-control" id="size"  ng-model="size" required ng-change="onChangeSize()">
                                <option value="{{x}}" ng-repeat="x in headSize">{{x}}</option>
                            </select>
                            <p ng-show="job.size.$invalid && job.size.$touched" class="help-block">Size required.</p>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <select name="stock" class="form-control" id="stock"  ng-model="stock">
                                <option value="{{x.key}}" ng-repeat="x in dataStock">{{x.value}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <select name="color" class="form-control" id="color"  ng-model="color">
                                <option value="{{x.key}}" ng-repeat="x in dataColor">{{x.value}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="runsize">Run size</label>
                            <select name="runsize" class="form-control" id="runsize"  ng-model="runsize" required>
                                <option value="{{x.key}}" ng-repeat="x in dataRunsize">{{x.value}}</option>
                            </select>
                        </div>

                        <div class="form-group" ng-if="ready">
                            <label for="mail_delivery_date">Target in Mailbox date</label>
                            <p>Subject to USPS Mail Delivery</p>
                            <datepicker  
                                date-format="MM/dd/yyyy" 
                                date-disabled-dates="{{disabled_dates}}"
                                date-set="{{start_date}}" 
                                date-min-limit="{{start_date}}" 
                                date-max-limit="{{end_date}}">
                                <input class="form-control" name="mail_delivery_date" ng-model="appForm.mail_delivery_date" type="text" required>
                            </datepicker>
                        </div>
                        

                        <br>
                        <div ng-if="isDev">
                            <h3>Order Summery</h3>
                            <p>Product Name :{{product_chosen}}</p>
                            <p>Product UUID :{{product_chosen_uuid}}</p>
                        </div>
                        <div class="order-summery"><p>Pricing will be available once routes are selected.</p></div>

                        <button type="submit" class="btn btn-success btn-lg btn-block" ng-disabled="job.$invalid"><span ng-if="buttonLoader" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Select Routes</button>
                    </form>
                </div>
            </div>
        </div>


    </body>
</html>