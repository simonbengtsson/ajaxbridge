## Ajax Bridge
The purpose of AjaxBridge is to act as a proxy to circumvent the cross origin policy. It enables any javascript
to send any request to any server and get the complete response back, including cookie headers.

### Usage
This example fetches the html of the twitter homepage. The only required option is url`.

    var options = {
        url: 'https://twitter.com/',
        method: 'GET',
        headers: {
            'User-Agent': 'AjaxBridge',
            'Other-Header': 'Value'
        },
        content: ''
    };

    $.post('http://ajax-bridge.appspot.com', options, function (res) {
        console.log(res);
    });

### Hosting and advanced use cases
Normally you use AjaxBridge by sending requests to [http://ajax-bridge.appspot.com](http://ajax-bridge.appspot.com).
However, sometimes it might be preferable to install it in your own project which can be done with `composer install ajaxbridge`.
The simplest way to host your own AjaxBridge is to upload all the files in this repository as is to your server of choice.
You might want to tweak index.php or example.php. If you want to use Google App Engine, you first have to create a new
application in the [Google Cloud Console](https://console.developers.google.com/) and change the app.yaml` accordingly.

### Licence: MIT