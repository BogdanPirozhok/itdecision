<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="{{ asset('css/confirm.css?v='. time()) }}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/vuetify-cabinet.css?v='.time())}}" />
        <title>Laravel Vuetify</title>
    </head>
  <body>
    
    <div id="editor">
        <index></index>
        <confirm-form ref="confirm"></confirm-form>
    </div>
    <script type="text/javascript">
        var data = <?php echo json_encode($data) ?>;
        var _token = '<?= csrf_token() ?>';
    </script>
    <script src="{{ asset('js/manifest.js?v='. time()) }}"></script>
    <script src="{{ asset('js/vendor.js?v='. time()) }}"></script>
    <script src="{{ asset('js/editor.js?v='. time()) }}"></script>
  </body>
</html>
