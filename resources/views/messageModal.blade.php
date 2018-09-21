<div class="modal-header">
    <h3 class="modal-title" id="modal-title">{{trans('messages.modal_title')}}</h3>
</div>
<form name="frmAddMessage" class="form-horizontal dropzone" novalidate="">
    <div class="modal-body" id="modal-body">

        <div class="form-group error">
            <label for="name" class="col-sm-3 control-label">{{trans('messages.modal_name')}}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control has-error vld" id="name" name="name" placeholder="{{trans('messages.modal_name')}}" value=""
                       ng-model="message.name" ng-required="true">
                <span style="color: red">@{{err.name.toString()}}</span>
            </div>
        </div>
        <div class="form-group error">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control has-error vld" id="email" name="email" placeholder="{{trans('messages.email_placeholder')}}" value=""
                       ng-model="message.email" ng-required="true">
                <span ng-show="frmAddMessage.email.$error.email">{{trans('messages.invalid_email')}}</span>
            </div>
        </div>
        <div class="form-group error">
            <label for="msgLink" class="col-sm-3 control-label">{{trans('messages.link')}}</label>
            <div class="col-sm-9">
                <input class="form-control" rows="3" class="form-control" id="msgLink" name="msgLink" placeholder="{{trans('messages.link_placeholder')}}" value="" ng-model="message.msgLink" ng-required="false" >
                <span style="color: red" class="help-inline">@{{err.msgLink.toString()}}</span>
            </div>
        </div>
        <div class="form-group error">
            <label for="text" class="col-sm-3 control-label">{{trans('messages.modal_msg')}}</label>
            <div class="col-sm-9">
                <textarea class="form-control vld" rows="3" class="form-control has-error" id="text" name="text" placeholder="{{trans('messages.text_placeholder')}}" value="" ng-model="message.text" ng-required="true" ></textarea>
            </div>
        </div>
        <div class="row">
            <label for="text" class="col-sm-3 control-label text-right">{{trans('messages.modal_pic')}}</label>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-9">
                        <button class="btn-primary btn-sm" dropzone="dropzoneConfig">
                            {{trans('messages.modal_pic_btn')}}
                        </button>
                    </div>
                    <div class="col-sm-3">
                        <button ng-click="cancelPic()" class="btn-danger btn-sm">{{trans('messages.modal_pic_cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal-footer">
           <!--<div class="row">
                <div
                        vc-recaptcha
                        key="'6LcvT20UAAAAAIeQWBSWzdSydvqw5jbjLmv-aJk6'"
                        theme="dark"
                ></div>-->

            <br>
            <div class="row">
                <button type="button" class="btn btn-lg btn-block btn-success" id="btn-save" ng-click="addMessage()" ng-disabled="frmAddMessage.$invalid">{{trans('messages.modal_add_msg_btn')}} </button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
            </div>
        </div>
    </form>

</div>



