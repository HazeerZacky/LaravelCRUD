<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('plugins')}}/bootstrap/css/bootstrap.min.css" >
    <script src="{{asset('plugins')}}/bootstrap/js/bootstrap.bundle.min.js" ></script>
    <!-- jquery -->
    <script src="{{asset('plugins')}}/jquery/jquery.min.js"></script>
    <!-- toastr -->
	<link rel="stylesheet" type="text/css" href="{{asset('plugins')}}/toastr/toastr.min.css">
    <script src="{{asset('plugins')}}/toastr/toastr.min.js"></script>

    <title>Test</title>
</head>

<body>
    <div class="text-center mt-5">
        <form style="max-width:480px; margin:auto;" action="/log" method="post">
        @csrf
            <h1 class="mt-4">Please sign in</h1>
            <input type="email" name="email" id="emailAddress" class="form-control mt-3" placeholder="Email Address" required autofocus>
            <input type="password" name="password" id="password" class="form-control mt-3" placeholder="Password" required>
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="submit">Sign In</button>
            </div>
        </form>
    </div>


<!-- Alert Part Start -->
    @if(Session::has('message'))
    <script>
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    </script>
    @endif

    @if($errors->any())
        @foreach($errors->all()  as $error)
        <script>
        toastr.info("{{$error}}");
        </script>
        @endforeach
    @endif
<!-- Alert Part End -->
</body>
</html>