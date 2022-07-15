<div>
    @if(session()->has('success'))
        <script>
            mw.notification.success('{{ session('success') }}');
        </script>
    @endif

    @if(session()->has('error'))
       <script>
           mw.notification.error('{{ session('error') }}');
       </script>
    @endif
</div>
