  'use strict';
  ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();
        var meetConfig = {
            apiKey: api_key,
            apiSecret: secret_key,
            meetingNumber: meeting_id,
            userName: username,
            passWord: meeting_password,
            leaveUrl: link,
            role: 1
        };
        var signature = ZoomMtg.generateSignature({
            meetingNumber: meetConfig.meetingNumber,
            apiKey: meetConfig.apiKey,
            apiSecret: meetConfig.apiSecret,
            role: meetConfig.role,
            success: function (res) {
                console.log(res.result);
            }
        });
        ZoomMtg.init({
            leaveUrl: meetConfig.leaveUrl,
            isSupportAV: true,
            success: function () {
                ZoomMtg.join(
                        {
                            meetingNumber: meetConfig.meetingNumber,
                            userName: meetConfig.userName,
                            signature: signature,
                            apiKey: meetConfig.apiKey,
                            passWord: meetConfig.passWord,
                            success: function (res) {
                                $('#nav-tool').hide();
                            },
                            error: function (res) {
                                console.log(res);
                            }
                        }
                );
            },
            error: function (res) {
                console.log(res);
            }
        });