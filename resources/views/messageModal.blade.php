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
                <span class="help-inline" style="color: red" ng-show="frmAddMessage.name.$invalid && frmAddMessage.name.$touched">{{trans('messages.field_required')}}</span>
                <span style="color: red">@{{err.name.toString()}}</span>
            </div>
        </div>
        <div class="form-group error">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control has-error vld" id="email" name="email" placeholder="{{trans('messages.email_placeholder')}}" value=""
                       ng-model="message.email" ng-required="true">
                <span class="help-inline" style="color: red"
                      ng-show="frmAddMessage.email.$invalid && frmAddMessage.email.$touched">{{trans('messages.invalid_email')}}</span>
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
                <span class="help-inline" style="color: red" ng-show="frmAddMessage.text.$invalid && frmAddMessage.text.$touched">{{trans('messages.field_required')}}</span>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-3 control-label text-right">{{trans('messages.modal_pic')}}</label>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-9">
                        <button class="btn-primary btn-sm" dropzone="dropzoneConfig">
                            {{trans('messages.modal_pic_btn')}}
                        </button>
                        <div ng-if="errorMessage == 'Ok'"><p class="green">@{{errorMessage}}</p></div>
                        <div ng-if="errorMessage != 'Ok'"><p class="red">@{{errorMessage}}</p></div>
                           
                    </div>
                    <div class="col-sm-3">
                        <button ng-click="cancelPic()" class="btn-danger btn-sm">{{trans('messages.modal_pic_cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal-footer">
             <div class="row">
                <div
                        vc-recaptcha
                        key="'6LdmBG8UAAAAAOAEfE1RkyH_mkb_KBR3UhP_NUDU'"
                        theme="dark"
                ></div>
           </div>
          
            <br>
            <div class="row">
                <button type="button" class="btn btn-lg btn-success" id="btn-save" ng-click="addMessage()" ng-disabled="frmAddMessage.$invalid">{{trans('messages.modal_add_msg_btn')}} </button>
                <button class="btn btn-lg btn-warning" type="button" ng-click="cancel()">{{trans('messages.modal_cancel_btn')}}</button>
            </div>
        </div>
    </form>

</div>



