<div class="jumbotron">
    <div class="container">
        <h1>{{trans('messages.title')}}</h1>
        <p>{{trans('messages.title_dscr')}}</p>
    </div>
</div>
<div class="container">
    <div class="row" >
        <div class="col-md-8">
            <h1>{{trans('messages.msgs')}}</h1>
        </div>
        <div class="col-md-4 text-right">
            <div class="modal-demo">
                <button type="button" class="btn btn-primary btn-lg" style="margin-top: 20px"  ng-click="open()">{{trans('messages.btnAddNewMsg')}} <i class="glyphicon glyphicon-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="row text-center"><h3>{{trans('messages.tableDscr')}}</h3></div>
        <table class="table table-list-search table-striped" id="myTable" ng-init="getMessages()">
            <thead>
            <tr>
                <th>ID</th>
                <th ng-click="sortBy('name')" style="cursor: pointer">
                    {{trans('messages.name')}} <i ng-class="className"></i>
                </th>
                <th>Email</th>
                <th>{{trans('messages.link')}} </th>
                <th>{{trans('messages.text')}} </th>
                <th>{{trans('messages.pic')}} </th>
                <th ng-click="sortBy('created_at')" style="cursor: pointer">
                    {{trans('messages.created_at')}} 	<i ng-class="classCrAt"></i>
                </th>
            </tr>
            </thead>
            <tbody >
            <tr ng-repeat="message in messages">
                <td>@{{  message.id }}</td>
                <td>@{{  message.name }}</td>
                <td><a href="mailto:@{{  message.email }}?Subject=Гостевая книга" target="_top">@{{  message.email }}</a></td>
                <td><a href="@{{  message.link }}">@{{  message.link }}</a></td>
                <td>@{{ message.text }}</td>
                <td>
                    <div ng-if="message.images[0].path.length">
                        <a target="_blank" href="/storage/@{{message.images[0].path}}">
                            <img id="myImg" ng-src="/storage/@{{message.images[0].path}}" alt="no picture" class="pic">
                        </a>
                    </div>
                </td>
                <td>@{{  message.created_at }}</td>
            </tr>
            </tbody>
        </table>

    <!--Pagination-->
    <div class="row text-center">
        <ul uib-pagination total-items="total" ng-model="currentPage" max-size="maxSize" class="pagination-sm" boundary-links="true" num-pages="lastPage" ng-change="getPaginationData(currentPage)"></ul>
        <pre>{{trans('messages.page')}}: @{{currentPage}} / @{{lastPage}}</pre>
    </div>
</div>
<hr>
<footer class="text-center">
    <p>{{trans('messages.footer')}}</p>
</footer>
</div>