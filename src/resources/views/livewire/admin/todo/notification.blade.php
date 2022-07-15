<div>
    @if(session()->has('success'))
        <script id="notification-{{time()}}">
            mw.notification.success('{{ session('success') }}');
        </script>
    @endif

    @if(session()->has('error'))
       <script id="notification-{{time()}}">
           mw.notification.error('{{ session('error') }}');
       </script>
    @endif
</div>
