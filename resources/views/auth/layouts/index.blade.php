@include('auth.layouts.head', $data)
@include('auth.layouts.header', $data)
@include($data['content'], $data)
@include('auth.layouts.footer', $data)