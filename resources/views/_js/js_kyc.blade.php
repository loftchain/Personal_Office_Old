<script>
    console.log('kyc script init')
    var civicSip = new civic.sip({ appId: '4b2Zj8AtT' });

    var button = document.querySelector('#signupButton');
    button.addEventListener('click', function () {
        civicSip.signup({ style: 'popup', scopeRequest: civicSip.ScopeRequests.BASIC_SIGNUP });
    });

    // Listen for data
    civicSip.on('auth-code-received', function (event) {

        // encoded JWT Token is sent to the server
        var jwtToken = event.response;

        // Your function to pass JWT token to your server
        $.ajax({
            url: '{{ route('kyc.user.update') }}',
            type: 'GET',
            data: {token: jwtToken},
            success: data => {
                console.log('Success' + data)
            },
            error: data => {
                console.log('Error' + data)
            }

        })
    });

    civicSip.on('user-cancelled', function (event) {
        /*
            event:
            {
              event: "scoperequest:user-cancelled"
            }
        */
    });

    civicSip.on('read', function (event) {
        /*
            event:
            {
              event: "scoperequest:read"
            }
        */
    });

    // Error events.
    civicSip.on('civic-sip-error', function (error) {
        // handle error display if necessary.
        console.log('   Error type = ' + error.type);
        console.log('   Error message = ' + error.message);
    });
</script>