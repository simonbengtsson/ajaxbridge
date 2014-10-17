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
        console.log(res); // See example response below
    });

    {
      "protocol": "HTTP/1.1",
      "status": 200,
      "statusText": "OK",
      "headers": {
        "cache-control": "no-cache, no-store, must-revalidate, pre-check=0, post-check=0",
        "content-security-policy-report-only": "default-src https:; connect-src https:; font-src https",
        "content-type": "text/html;charset=utf-8",
        "date": "Fri, 17 Oct 2014 18:16:10 UTC",
        "expires": "Tue, 31 Mar 1981 05:00:00 GMT",
        "last-modified": "Fri, 17 Oct 2014 18:16:10 GMT",
        "ms": "S",
        "pragma": "no-cache",
        "server": "tsa_a",
        "set-cookie": "guest_id=v1%3A141356977060427045; Domain=.twitter.com; Path=/; Expires=Sun, 16-Oct-2016 18:16:10 UTC",
        "status": "200 OK",
        "strict-transport-security": "max-age=631138519",
        "x-connection-hash": "e43d6d1abaacfa287738a7a17f329665",
        "x-content-type-options": "nosniff",
        "x-frame-options": "SAMEORIGIN",
        "x-transaction": "a1413ba660e67325",
        "x-ua-compatible": "IE=edge,chrome=1",
        "x-xss-protection": "1; mode=block",
        "X-Google-Cache-Control": "remote-fetch",
        "Via": "HTTP/1.1 GWA"
      },
      "content": "<!DOCTYPE html>\n<!--[if IE 8]><html class=\"lt-ie10 ie8\" lang=\"en data-scribe-reduced--containLogin or Sign up (...)"
    }

### Hosting and advanced use cases
Normally you use AjaxBridge by sending requests to [http://ajax-bridge.appspot.com](http://ajax-bridge.appspot.com).
However, sometimes it might be preferable to install it in your own project which can be done with `php composer.phar require simonbengtsson/ajaxbridge:dev-master`.
The simplest way to host your own AjaxBridge is to upload all the files in this repository as is to your server of choice.
You might want to tweak index.php or example.php. If you want to use Google App Engine, you first have to create a new
application in the [Google Cloud Console](https://console.developers.google.com/) and change the app.yaml` accordingly.

### Licence: MIT