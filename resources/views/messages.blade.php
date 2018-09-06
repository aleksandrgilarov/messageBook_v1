
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>{{trans('messages.title')}}</h1>
        <p>{{trans('messages.title_dscr')}}</p>
    </div>
</div>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row" >
                    <div class="col-md-8">
                        <h1>{{trans('messages.msgs')}}</h1>
                    </div>
                    <div class="col-md-4 text-right"><button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px" ng-click="showModal()">{{trans('messages.btnAddNewMsg')}} <i class="glyphicon glyphicon-plus"></i></button></div>
                </div>
                <div class="row text-center"><h3>{{trans('messages.tableDscr')}}</h3></div>
                <div class="col-md-12">
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
                            <td><ul ng-repeat="image in message.images">
                                    <a target="_blank" href="/storage/@{{image.path}}">
                                        <img id="myImg" src="/storage/@{{image.path}}" alt="no picture" class="pic">
                                    </a>
                                </ul></td>
                            <td>@{{  message.created_at }}</td>

                        </tr>
                        </tbody>
                    </table>
                    <!-- End of Table-to-load-the-data Part -->
                </div>

                <!--Pagination-->
                <div class="row text-center">
                    <ul uib-pagination total-items="total" ng-model="currentPage" max-size="maxSize" class="pagination-sm" boundary-links="true" num-pages="lastPage" ng-change="getPaginationData(currentPage)"></ul>
                    <pre>{{trans('messages.page')}}: @{{currentPage}} / @{{lastPage}}</pre>
                </div>

                <!-- Modal-->
                <div class="modal fade" id="addMessageModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">{{trans('messages.modal_title')}}</h4>
                            </div>
                            <form name="frmAddMessage" class="form-horizontal dropzone" novalidate="">
                                <div class="modal-body">
                                    <div class="form-group error">
                                        <label for="name" class="col-sm-3 control-label">{{trans('messages.modal_name')}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Ваше имя" value=""
                                                   ng-model="message.name" ng-required="true">
                                            <span class="help-inline"
                                                  ng-show="frmAddMessage.name.$invalid && frmAddMessage.name.$touched">{{trans('messages.field_required')}}</span>

                                            <span style="color: red">@{{err.name.toString()}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                        <label for="email" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control has-error" id="email" name="email" placeholder="Э-почта" value=""
                                                   ng-model="message.email" ng-required="true">
                                            <span class="help-inline"
                                                  ng-show="frmAddMessage.email.$invalid && frmAddMessage.email.$touched">{{trans('messages.required_email')}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                        <label for="msgLink" class="col-sm-3 control-label">{{trans('messages.link')}}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" rows="3" class="form-control" id="msgLink" name="msgLink" placeholder="Ссылка на ваш сайт" value="" ng-model="message.msgLink" ng-required="false" >
                                            <span style="color: red" class="help-inline">@{{err.msgLink.toString()}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group error">
                                        <label for="text" class="col-sm-3 control-label">{{trans('messages.modal_msg')}}</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" class="form-control has-error" id="text" name="text" placeholder="Текст сообщения" value="" ng-model="message.text" ng-required="true" ></textarea>
                                            <span class="help-inline"
                                                  ng-show="frmAddMessage.text.$invalid && frmAddMessage.text.$touched">{{trans('messages.field_required')}}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="text" class="col-sm-3 control-label text-right">{{trans('messages.modal_pic')}}</label>
                                        <div class="col-sm-9">

                                            <button class="btn-primary btn-sm" dropzone="dropzoneConfig">
                                                {{trans('messages.modal_pic_btn')}}
                                            </button>
                                            <button ng-click="cancelPic()" class="btn-danger btn-sm">{{trans('messages.modal_pic_cancel')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div
                                                vc-recaptcha
                                                key="'6LcvT20UAAAAAIeQWBSWzdSydvqw5jbjLmv-aJk6'"
                                                theme="dark"
                                        ></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <button type="button" class="btn btn-lg btn-block btn-success" id="btn-save" ng-click="addMessage()" ng-disabled="frmAddMessage.$invalid">{{trans('messages.modal_add_msg_btn')}} </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<footer class="text-center">
    <p>{{trans('messages.footer')}}</p>
</footer>
</div>