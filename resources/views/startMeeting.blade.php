@extends('layouts.app')

@section('content')
<div class="row">
    <div class="container">
        <div class="panel panel-default">
            <!-- <div class="panel-heading">
                <h3>List</h3>
                
            </div> -->

            <div class="panel-body">


                <div class="ReactModal__Body--open">

                    <div id="zmmtg-root"></div>
                    <div id="aria-notify-area"></div>

                    <div class="ReactModalPortal"></div>
                    <div class="ReactModalPortal"></div>
                    <div class="ReactModalPortal"></div>
                    <div class="ReactModalPortal"></div>
                    <div class="global-pop-up-box"></div>
                    <div class="sharer-controlbar-container sharer-controlbar-container--hidden"></div>

                </div>
                <!-- <div id="zmmtg-root"></div>
                <div id="aria-notify-area"></div> -->
                <input type="text" name="signature" id="signature"
                    value="{{generate_signature('5xdjKWxjTuyRmr5OpXhDDg','F8CSDU7zkccN6PVnA4VhLy0UrrXTlV3mJ6XA',$meeting_id,1)}}">
                <input type="text" name="meeting_ID" id="meeting_ID" value="{{$meeting_id}}">
            </div>
        </div>

    </div>
</div>

@endsection
@section('script')

<!-- import ZoomMtg -->
<script src="https://source.zoom.us/zoom-meeting-1.7.8.min.js"></script>
<!-- <script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script> -->

<script>
$(document).ready(function() {
    // ZoomMtg.setZoomJSLib("https://jssdk.zoomus.us/1.7.8/lib", "/av");

    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();
    var signature = $('#signature').val();
    const meetingConfig = {
        apiKey: "5xdjKWxjTuyRmr5OpXhDDg",
        meetingNumber: $("#meeting_ID").val(),
        leaveUrl: "http://localhost:8000/create/meeting",
        userName: "Mahesh Racharla",
        userEmail: "6r.mahesh99cena@gmail.com",
        passWord: "123456", // if required
        role: "1" // 1 for host; 0 for attendee
    };

    function beginJoin(signature) {
        ZoomMtg.init({
            leaveUrl: meetingConfig.leaveUrl,
            // webEndpoint: meetingConfig.webEndpoint,
            success: function(res) {
                console.log(res);
                // console.log("signature", signature);
                // ZoomMtg.i18n.load(meetingConfig.lang);
                // ZoomMtg.i18n.reload(meetingConfig.lang);
                ZoomMtg.join({
                    meetingNumber: meetingConfig.meetingNumber,
                    userName: meetingConfig.userName,
                    signature: signature,
                    apiKey: meetingConfig.apiKey,
                    userEmail: meetingConfig.userEmail,
                    passWord: meetingConfig.passWord,
                    success: function(res) {
                        console.log("join meeting success");
                        console.log("get attendeelist");
                        ZoomMtg.getAttendeeslist({});
                        ZoomMtg.getCurrentUser({
                            success: function(res) {
                                console.log("success ", res.result
                                    .currentUser);
                            },
                            error: function(res) {
                                console.log(res);
                            },
                        });
                    },
                    error: function(res) {
                        console.log(res);
                    },
                });
            },
            error: function(res) {
                console.log(res);
            },
        });

        ZoomMtg.inMeetingServiceListener('onUserJoin', function(data) {
            console.log('inMeetingServiceListener onUserJoin', data);
        });

        ZoomMtg.inMeetingServiceListener('onUserLeave', function(data) {
            console.log('inMeetingServiceListener onUserLeave', data);
        });

        ZoomMtg.inMeetingServiceListener('onUserIsInWaitingRoom', function(data) {
            console.log('inMeetingServiceListener onUserIsInWaitingRoom', data);
        });

        ZoomMtg.inMeetingServiceListener('onMeetingStatus', function(data) {
            console.log('inMeetingServiceListener onMeetingStatus', data);
        });
    }

    beginJoin(signature);
    // beginJoin(meetingConfig.signature);
});
</script>

@endsection