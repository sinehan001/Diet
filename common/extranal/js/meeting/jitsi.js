  "use strict";
  $(document).ready(function () {
        "use strict";
        const domain = "meet.jit.si";
        document.getElementById('meeting');
        const options = {
            roomName: room_id,
            height: 500,
            parentNode: document.querySelector("#meeting"),
            userInfo: {
                email: $('#email').val(),
                displayName: $('#username').val()
            },
            enableClosePage: true,
            SHOW_PROMOTIONAL_CLOSE_PAGE: true,
           
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    });