<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('library/img/favicon.png') }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('library/img/favicon.png') }}" type="image/x-icon" />

        <link href="{{ asset('library/css/confirm.css?v='. $version) }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/home.css?v='. $version) }}" rel="stylesheet" />

        <link href="//cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet" />
    </head>
  <body>

    <div id="editor">
        <index></index>
        <confirm-item ref="confirm"></confirm-item>
    </div>
    <script type="text/javascript">
        var data = <?= json_encode($data) ?>;
        var _token = '<?= csrf_token() ?>';
    </script>

    <script src="{{ asset('assets/js/manifest.js?v='. $version) }}"></script>
    <script src="{{ asset('assets/js/vendor.js?v='. $version) }}"></script>
    <script src="{{ asset('assets/js/home.js?v='. $version) }}"></script>
  </body>
</html>
