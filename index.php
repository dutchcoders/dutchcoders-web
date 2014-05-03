<html ng-app="App">
    <head>
        <title>DutchCoders - Making stuff, because we can</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-title" content="DutchCoders">
        <meta name="apple-mobile-web-app-capable" content="yes" />  
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />  
        <meta name="apple-mobile-web-app-title" content="DutchCoders">
        
        <link href='//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <link href='//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <link href='//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
        <link href='./assets/css/style.css' rel='stylesheet' type='text/css'>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular-animate.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular-resource.js"></script>
        <script src="./assets/js/App.js"></script>
    </head>
    <body>
        <div class="container" ng-controller="AppController">
            <center>
                <h1>
                    DutchCoders
                </h1>
                <h4>Coding awesome things, because we can.<br/> Because we want to learn.<br/> Because we want to make the internet a better place</h4>                
            </center>
            
            <div class="controls clearfix">
                <div class="view-container">
                    <div class="inner">
                        <i ng-click="settings.view = 'grid'" ng-class="{'active': settings.view == 'grid' }" class="fa fa-th-large grid-view"></i>
                        <i ng-click="settings.view = 'list'" ng-class="{'active': settings.view == 'list' }" class="fa fa-th-list list-view"></i>
                        
                        <i ng-click="sortName();" ng-class="{'active': settings.sort == 'name', 'fa-sort-alpha-asc': !settings.reverse || settings.sort != 'name', 'fa-sort-alpha-desc':settings.reverse && settings.sort == 'name' }" class="fa a-z"></i>
                        <i ng-click="sortTime();" ng-class="{'active': settings.sort == 'updated_at' }" class="fa fa-clock-o sort-time"></i>
                        <i ng-click="sortWatchers();" ng-class="{'active': settings.sort == 'stargazers_count', 'fa-star': settings.reverse || settings.sort != 'watchers_count', 'fa-star-o': !settings.reverse && settings.sort == 'stargazers_count' }" class="fa"></i>
                    </div>
                </div>
                
                <div class="search-container">
                    <input class="search-field" ng-model="search" placeholder="Search projects"/>
                    <i class="fa fa-search search-icon"></i>
                </div>
            </div>
            
            <div class="fancy-line"></div>

            <div class="row content" ng-show="settings.view == 'grid'">
                <div ng-animate="animation" ng-repeat="repo in repos | orderBy:settings.sort:settings.reverse | filter:search" class="col-md-3 col-sm-4 tile">
                    <div class="tile-inner">
                        <h5><a ng-href="{{ repo.html_url }}">{{ repo.name }}</a></h5>
                        <div class="type">{{ repo.fork ? 'fork' : 'owned' }}</div>
                        <div class="content">
                            {{ repo.description }}
                        </div>
                        <div class="info">
                            <div class="inner">
                                <a class="pull-left" ng-href="{{ repo.html_url }}">
                                    <i class="fa fa-github"></i>
                                </a>
                                <a class="pull-right small" ng-href="{{ repo.forks_url }}">
                                    <span>{{ repo.forks_count }}</span>
                                    <i class="fa fa-code-fork"></i>
                                </a>
                                 <a class="pull-right small" ng-href="{{ repo.stargazers_url }}">
                                    <span>{{ repo.stargazers_count }}</span>
                                    <i class="fa fa-star"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <ul class="content" ng-show="settings.view == 'list'">
                <li ng-repeat="repo in repos | orderBy:settings.sort:settings.reverse | filter:search">
                    {{ repo.name }}
                </li>
            </ul>
            <div class="fancy-line top"></div>
            <p class="pull-right footer">
                Also, we are {{ openSourcePercentage }}% open source, {{ openSourceCount }} out of {{ repos.length}} are public Git repository's.
            </p>
            <p class="pull-left footer">
                DutchCoders {{ year }}   
            </p>
        </div>
    </body>
</html>