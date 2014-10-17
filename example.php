<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AjaxBridge</title>

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/styles/default.min.css">

    <script src="https://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <script>

        // Request example
        var options = {
            url: 'https://twitter.com/',
            method: 'GET',
            headers: {
                'User-Agent': 'AjaxBridge',
                'Other-Header': 'Value'
            },
            content: ''
        };

        $.post('/', options, function (res) {
            $('#result').text(JSON.stringify(res, undefined, 2));
            $('pre code').each(function (i, block) {
                hljs.highlightBlock(block);
            });
        }).fail(function(res, r2, r3) {
            $('#result').text('Error: ' + r2 + ' Status: ' + res.status);
            console.log(res);
        });

    </script>

    <style>
        body {
            padding: 20px;
            font-family: Optima, Segoe, "Segoe UI", Candara, Calibri, Arial, sans-serif;
        }

        h1 {
            text-align: center;
            font-family: Optima, Segoe, "Segoe UI", Candara, Calibri, Arial, sans-serif;
            font-size: 25px;
            color: #888;
        }

        .container {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
        }

        p {
            text-align: center;
        }

        pre {
            overflow: scroll;
        }

        h4 {
            margin-bottom: 0;
            color: #555;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>AjaxBridge</h1>

    <p>
        The purpose of AjaxBridge is to act as a proxy to circumvent the cross origin policy. It enables any javascript
        to send any request to any server and get the complete response back, including cookie headers.
        Source and more information are found on github.
    </p>

    <h4>Example usage:</h4>

<pre><code>var options = {url: 'http://twitter.com'}
$.post('http://ajax-bridge.appspot.com', options, function(res) {
    console.log(res); // Response, see below
});
</code></pre>

    <h4>Response:</h4>
    <pre><code class="json" id="result" style="min-height: 200px;">Fetching...</code></pre>

</div>
</body>
</html>